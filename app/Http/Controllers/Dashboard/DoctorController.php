<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginDoctorRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Traits\UploadTrait;
use App\Services\Upload;
use Illuminate\View\View;

class  DoctorController extends Controller
{
    //
    use  UploadTrait;


    //  public function store(LoginDoctorRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard.doctor', absolute: false));
    // }
    //   public function store(Request $request)
    //   {
    //     $data=$request->validate([
    //         'email'=>"required|email|exists:doctors,email",
    //         "password"=>"required"
    //     ]);

    //     $doctor=Doctor::where("email",'=',$data['email'])->first();
    //     if($doctor)
    //     {
    //         if(!Hash::check($data['password'],$doctor->password))
    //         {
    //              return redirect('/login')->withErrors('error',"password worng");
    //         }
    //         else
    //         {
    //              Auth::guard('doctor')->login($doctor);
                 
    //            return redirect()->intended(route('dashboard.doctor'));      
    //         }

    //     }
    //     else{
    //         return redirect('/login')->withErrors('error',"doctor worng");


    //     }
    //   }



    // public function register(Request $request)
    // {
    //       $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Doctor::class],
    //         'password' => ['required'],
    //       'price'=>['required', 'string'],
    //       'phone'=>['required', 'string'],
    //       "oppointment"=>['required', 'string']
    //     ]);

    //     $user = Doctor::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'price'=>$request->price,
    //       'phone'=>$request->phone,
    //       "oppointment"=>$request->oppointment
    //     ]);

    //    // event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard.doctor', absolute: false));
    // }

    //  public function destroy(Request $request): RedirectResponse
    // {
    //     Auth::guard('doctor')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }


    public function index()
    {
      $doctors=Doctor::all();
      return view('dashboard.doctors.index',compact('doctors'));

    }

    public function show()
    {
      
    }

    public function create()
    {
      $sections=Section::all();
       $appointments=Appointment::all();
      return view("dashboard.doctors.create",compact('sections','appointments'));
      
    }

    public function store(Request $request)
    {

       $doctor=$request->validate([
        'name'=>"required|string|max:255",
        'email'=>"required|email|unique:doctors,email",
        'password'=>"required|min:3",
       
         'phone'=>"required",
        // 'oppointment'=>"required|array",
        // 'oppointment.*'=>"required|string",
        'section_id'=>"required|exists:sections,id",

        
       ]);

       $doctor['password']=Hash::make($doctor['password']);
       //$doctor['oppointment']=implode(',',$doctor['oppointment']);// اخليها كلمه واحده بس بيهم ,

        DB::beginTransaction();
      try {
    
   
    // عمليات قاعدة البيانات:
    
        $d=Doctor::create($doctor);
        $d->appointment_doctor()->attach($request->appointment);
        // $this->verifyAndStoreImage($request,'photo','Doctors',$d->id,"App\Models\Doctor");
        if($request->hasFile('photo'))
        {
                 //(new Upload())->Upload($request->file('image'),'Doctors',$d);
                 (new Upload())->upload($request->file('photo'),'Doctors',$d);
        }
         
        
    DB::commit(); // تم بنجاح، احفظ كل شيء
     session()->flash('add',"doctor add suc");
       return redirect()->route('doctors.index');
} 

catch (\Exception $e) {
    DB::rollBack(); // حصل خطأ، رجع كل شيء كما كان
     // أو تقدر تعرض رسالة خطأ
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
      
      
      
    }

    public function edit(Request $request,$id)
    {
      $doctor=Doctor::find($id);
       $sections=Section::all();
       $appointments=Appointment::all();
      return view("dashboard.doctors.edit",compact('sections','doctor',"appointments"));
      
    }

    public function update(Request $request ,$id)
    {
 
      $do=Doctor::find($id);
       $doctor=$request->validate([
        'name'=>"required|string|max:255",
        'email'=>"required|email|unique:doctors,email,".$do->id,
         'phone'=>"required",
        'section_id'=>"required|exists:sections,id",
       ]);
        DB::beginTransaction();
      try {

         $do->update($doctor);
        if($request->has('photo'))
        {
          if($do->image)
          {
            $img=$do->image->image_name;
             (new Upload())->delete('Doctors',$img);
            //$this->deleteImage("Doctors/".$img,$request->id,$img);

          }
          // $this->verifyAndStoreImage($request,'photo','Doctors',$do->id,"App\Models\Doctor");
          (new Upload())->upload($request->file('photo'),"Doctors",$do);

        }
        
        $do->appointment_doctor()->sync($request->appointmemt);
       DB::commit(); // تم بنجاح، احفظ كل شيء
     session()->flash('update',"doctor update suc");
       return redirect()->route('doctors.index');
} 

catch (\Exception $e) {
    DB::rollBack(); // حصل خطأ، رجع كل شيء كما كان
     // أو تقدر تعرض رسالة خطأ
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
      





      
    }
    public function destroy(Request $request)
    {

      if($request->page_id==1)
      { if($request->image)
        {
          $this->deleteImage("Doctors/".$request->image,$request->id,$request->image);
        }
        $doctor=Doctor::find($request->id)->delete();
         session()->flash('delete',"doctor delete suc");
        return redirect()->route('doctors.index');


      }
      else{

          // delete selector doctor
          $delete_select_id = explode(",", $request->delete_select_id);
          foreach ($delete_select_id as $ids_doctors){
              $doctor = Doctor::findorfail($ids_doctors);
              if($doctor->image){
                  $this->deleteImage('Doctors/'.$doctor->image->image_name,$ids_doctors,$doctor->image->image_name);
              }
          }

          Doctor::destroy($delete_select_id);
          session()->flash('delete');
          return redirect()->route('doctors.index');


      }
      
    }

    public function update_password(Request $request)
    {
      $data=$request->validate([
        'password'=>"required|min:3",
          'password_confirmation'=>"required|min:3"
           
      ]);
      $doctor=Doctor::where('id',$request->id);
      $doctor->update([
        'password'=>Hash::make($data['password'])
      ]);
      $doctor->save();
      session()->flash('update',"update suc");
      return redirect()->route('doctors.index');


    }

    public function update_status(Request $request)
    {
      $status=$request->validate([
        'status'=>"required|in:0,1"
      ]);
      $doctor=Doctor::where("id",$request->id);
      $doctor->update([
        'status'=>$request->status
      ]);
    
      session()->flash('update',"update suc");
      return redirect()->route('doctors.index');




}
}



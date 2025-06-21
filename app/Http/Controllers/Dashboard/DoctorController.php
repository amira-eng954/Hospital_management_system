<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DoctorController extends Controller
{
    //


    //  public function store(LoginDoctorRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard.doctor', absolute: false));
    // }
      public function store(Request $request)
      {
        $data=$request->validate([
            'email'=>"required|email|exists:doctors,email",
            "password"=>"required"
        ]);

        $doctor=Doctor::where("email",'=',$data['email'])->first();
        if($doctor)
        {
            if(!Hash::check($data['password'],$doctor->password))
            {
                 return redirect('/login')->withErrors('error',"password worng");
            }
            else
            {
                 Auth::guard('doctor')->login($doctor);
                 
               return redirect()->intended(route('dashboard.doctor'));      
            }

        }
        else{
            return redirect('/login')->withErrors('error',"doctor worng");


        }
      }



    public function register(Request $request)
    {
          $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Doctor::class],
            'password' => ['required'],
          'price'=>['required', 'string'],
          'phone'=>['required', 'string'],
          "oppointment"=>['required', 'string']
        ]);

        $user = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'price'=>$request->price,
          'phone'=>$request->phone,
          "oppointment"=>$request->oppointment
        ]);

       // event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard.doctor', absolute: false));
    }

     public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}



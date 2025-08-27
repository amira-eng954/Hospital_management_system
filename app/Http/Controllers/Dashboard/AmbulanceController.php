<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Http\Requests\AmbulanceRequest;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    //
    public function index()
    {
        $ambulances=Ambulance::all();
          return view('dashboard.ambulances.index',compact('ambulances'));
    }

    public function create()
    {
       
          return view('dashboard.ambulances.create');
    }

    public function store(AmbulanceRequest $request)
    {
       $data =$request->validated();
       Ambulance::create($data);
          return redirect()->route('Ambulance.index');
    }


    public function edit($id)
    {
        $ambulance=Ambulance::find($id);
         return view('dashboard.ambulances.edit',compact('ambulance'));

    }

    public function update(Request $request)
    {
        $ambulance=Ambulance::find($request->id);
        if($request->has('is_available'))
        {
            $request->request->add(['is_available'=>2]);
        }
        else {
            {$request->request->add(['is_available'=>1]);
                }
        }
        $ambulance->update($request->all());
        return redirect()->route('Ambulance.index');
        

    }

     public function destroy(Request $request)
    {
      $ss=Ambulance::find($request->id);
      $ss->delete();
          return redirect()->route('Ambulance.index');
    }


}

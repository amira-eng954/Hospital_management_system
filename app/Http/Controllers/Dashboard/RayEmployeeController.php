<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\RayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeController extends Controller
{
    //

    public function index()
    {

              $ray_employees=RayEmployee::all();
              return view("dashboard.ray_employee.index",compact("ray_employees"));
    }

     public function store( Request $request )
    {   
        $request->validate([
             'name'=>"required",
             'email'=>'required|email|unique:ray_employees,email',
              'password'=>"required"
        ]);
        RayEmployee::create([
            'name'=>$request->name,
             'email'=>$request->email,
              'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('ray_employee.index');
    }

     public function update( Request $request, $id)
    {
       $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }

    

     public function destroy($id)
    {
       $RayEmployee= RayEmployee::find($id);
       $RayEmployee->delete();
        return redirect()->route('ray_employee.index');

    }
}

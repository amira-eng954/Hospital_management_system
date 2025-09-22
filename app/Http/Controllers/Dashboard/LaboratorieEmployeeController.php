<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\LaboratorieEmployee;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class LaboratorieEmployeeController extends Controller
{
    //
    public function index()
    {
        $laboratorie_employees= LaboratorieEmployee::all();
        return view("dashboard.laboratorie_employee.index",compact("laboratorie_employees"));


    }

     public function store(Request $request)
    {
        $data=$request=$request->validate([
            'name'=>"required",
            'email'=>"required|email|unique:laboratorie_employees,email",
            'password'=>"required|min:3"
        ]);
        $data['password']=Hash::make($data['password']);
        LaboratorieEmployee::create($data);
        session()->flash('add',"add suc");
        return redirect()->back();

        
        
    }

     public function update( Request $request,$id)
    {
          $data=$request=$request->validate([
            'name'=>"required",
            'email'=>"required|email|unique:laboratorie_employees,email,".$id,
            'password'=>'nullable'
        ]);
        $data2=LaboratorieEmployee::findorFail($id);
        if(!empty($request['password']))
        {
           $data['password']=Hash::make($request['password']);
        }
        else{
              $data['password']=$data2['password'];
        }
        $data2->update($data);
         return redirect()->back();
        
    }

     public function destroy($id)
    {
        $data=  LaboratorieEmployee::findorFail($id);
        $data->delete();
        return redirect()->back();


    }
   
}

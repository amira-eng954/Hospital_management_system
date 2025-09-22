<?php

namespace App\Http\Controllers\Dashboard_doctor;
use App\Http\Controllers\Controller;
use App\Models\Laboratorie;


use Illuminate\Http\Request;

class LaboratorieController extends Controller
{
    //

     public function store( Request $request)
    {
          Laboratorie::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
          ]);
          return redirect()->back();
    }
     public function update (Request $request ,$id)
    {
          $ray=Laboratorie::findorfail($id);
          $ray->update([
             'description'=>$request->description
          ]);
          return redirect()->back();
    }

    public function Laboratorie($id)
    {
        $ray=Ray::findorfail($id);
        $ray->delete();
         return redirect()->back();
    }

      public function view_laboratories($id)
    {
        $laboratories = Laboratorie::findorFail($id);
        //return "qqq";
        if($laboratories->doctor_id !=auth()->user()->id){
            //abort(404);
            return redirect()->route('404');
        }
       return view('dashboard.Doctor.Invoices.view_laboratories', compact('laboratories'));
    }
}


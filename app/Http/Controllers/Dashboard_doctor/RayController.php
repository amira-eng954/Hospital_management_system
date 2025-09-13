<?php

namespace App\Http\Controllers\Dashboard_doctor;
use App\Http\Controllers\Controller;
use  App\Models\Ray;
use Illuminate\Http\Request;

class RayController extends Controller
{
    //

    public function store( Request $request)
    {
          Ray::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
          ]);
          return redirect()->back();
    }
     public function update (Request $request ,$id)
    {
          $ray=Ray::findorfail($id);
          $ray->update([
             'description'=>$request->description
          ]);
          return redirect()->back();
    }

    public function destroy($id)
    {
        $ray=Ray::findorfail($id);
        $ray->delete();
         return redirect()->back();
    }
}

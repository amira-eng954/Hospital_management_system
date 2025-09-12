<?php

namespace App\Http\Controllers\Dashboard_doctor;
use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    //

    public function store(Request $request){
        $Diagnostic=$request->validate([
            'diagnosis'=>"required",
            'medicine'=>"required"
        ]);
         Diagnostic::create([
            'date'=>date('y-m-d'),
            'diagnosis'=>$request->diagnosis,
            'medicine'=>$request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id'=> $request->patient_id,
            'doctor_id' => $request->doctor_id,
            
         ]);
         return redirect()->route("invoices.index");
        

    }

     public function show($id){

         $patient_records= Diagnostic::where('patient_id','=',$id)->get();
           return view('dashboard.Doctor.Invoices.patient_record',compact('patient_records'));

        
    }
}

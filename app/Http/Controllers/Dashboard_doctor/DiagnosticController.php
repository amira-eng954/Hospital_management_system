<?php

namespace App\Http\Controllers\Dashboard_doctor;
use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\single_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticController extends Controller
{
    //

    public function store(Request $request){
     DB::beginTransaction();
     try{
        $dd=single_invoice::findorfail($request->invoice_id);
        $dd->update(['invoice_status'=>3]);
        
        $dd->save();
        //dd($dd->invoice_status);
        // $Diagnostic=$request->validate([
        //     'diagnosis'=>"required",
        //     'medicine'=>"required"
        // ]);
         Diagnostic::create([
            'date'=>date('y-m-d'),
            'diagnosis'=>$request->diagnosis,
            'medicine'=>$request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id'=> $request->patient_id,
            'doctor_id' => $request->doctor_id,
            
         ]);
          DB::commit();
         return redirect()->route("invoices.index");
        
     }
      catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }

     public function show($id){

         $patient_records= Diagnostic::where('patient_id','=',$id)->get();
           return view('dashboard.Doctor.Invoices.patient_record',compact('patient_records'));

        
    }

    public function add_review(Request $request){
     DB::beginTransaction();
     try{
        $dd=single_invoice::findorfail($request->invoice_id);
        $dd->update(['invoice_status'=>2]);
        $dd->save();
        $Diagnostic=$request->validate([
            'diagnosis'=>"required",
            'medicine'=>"required"
        ]);
         Diagnostic::create([
            'date'=>date('y-m-d'),
            'review_date' => date('Y-m-d H:i:s'),
            'diagnosis'=>$request->diagnosis,
            'medicine'=>$request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id'=> $request->patient_id,
            'doctor_id' => $request->doctor_id,
            
         ]);
          DB::commit();
         return redirect()->route("invoices.index");
        
     }
      catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

}

<?php

namespace App\Http\Controllers\Dashboard_doctor;
use App\Http\Controllers\Controller;
use  App\Models\Ray;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller
{
    //

     public function index($id){

         $patient_records = Diagnostic::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();
        $patient_Laboratories  = Laboratorie::where('patient_id',$id)->get();
        return view('Dashboard.doctor.invoices.patient_details',compact('patient_records','patient_rays','patient_Laboratories'));
    }
}

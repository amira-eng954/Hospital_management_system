<?php

namespace App\Http\Controllers\Dashboard_patient;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\single_invoice;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{

  private $patient;

       public function __construct()
     {
    $this->patient = auth('patient')->user()->id;
     }

    public function laboratories()
    {
       $laboratories=Laboratorie::where('patient_id',$this->patient)->get();
         return view('dashboard.dashboard_patient.laboratories',compact('laboratories'));


    }

     public function view_laboratories($id)
    {
       $laboratorie=Laboratorie::findorFail($id);
       if($laboratorie->patient_id != $this->patient)
       {
          return redirect()->route('404');
       }
        return view("dashboard.dashboard_laboratorie_employee.invoices.patient_details",compact("laboratorie"));


    }


    public function rays()
    {
          $rays =Ray::where('patient_id',$this->patient)->get();
          return view('dashboard.dashboard_patient.rays',compact('rays'));

         

    }

     public function view_ray($id)
    {
       $rays=Ray::findorFail($id);
       if($rays->patient_id != $this->patient)
       {
          return redirect()->route('404');
       }
         return view('dashboard.dashboard_ray_employee.invoices.patient_details', compact('rays'));


    }




    public function invoices()
    {
         $invoices=Single_invoice::where('patient_id',$this->patient)->get();
          return view('dashboard.dashboard_patient.invoices',compact('invoices'));

    }

    public function payments()
    {
       $payments= ReceiptAccount::where('patient_id',$this->patient)->get();
         return view('dashboard.dashboard_patient.payments',compact('payments'));
    }


    //
}

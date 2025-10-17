<?php

namespace App\Http\Controllers\Dashboard\appointments;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function index()
    {
      $appointments= Appointment::where('type','غير مؤكد')->get();
        return view('dashboard.appointments.index',compact('appointments'));



    } 

    public function index2()
    {
      $appointments= Appointment::where('type','مؤكد')->get();
        return view('dashboard.appointments.index2',compact('appointments'));



    } 


    public function approval(Request $request , $id)
    {
       $appointment= Appointment::findorfail($id);
       $appointment->update([
        'appointment'=>$request->appointment,
        'type'=>'مؤكد'
       ]);
       return redirect()->back();

    }


}

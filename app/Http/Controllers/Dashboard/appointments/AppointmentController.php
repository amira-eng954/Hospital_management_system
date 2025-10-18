<?php

namespace App\Http\Controllers\Dashboard\appointments;
use App\Models\Appointment;
use App\Mail\AppointmentConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
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
       Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment->appointment,$appointment->name));

       
        // send message mob
        $receiverNumber = '+201283386303';//$appointment->phone;
        $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber,[
            'from' => $twilio_number,
            'body' => $message
        ]);
        session()->flash('add');
       return redirect()->back();

    }


}

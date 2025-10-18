<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $message= false;
    public $message2=false;
   public $appointment_patient;

    public function mount(){

      $this->sections = Section::get();
      $this->doctors =[];

    }

    public function render()
    {
        return view('livewire.appointments.create',
            [
                'sections' => Section::get(),
              

            ]);
    }

    public function updatedSection($section_id){

       $this->doctors = Doctor::where('section_id',$section_id)->get();
    }

    public function store(){

        $appointment_count=Appointment::where('doctor_id',$this->doctor)->where('appointment_patient',$this->appointment_patient)->where('type','غير مؤكد')->count();
          $doctor_info = Doctor::find(1);
         if ($appointment_count == $doctor_info->number_of_statements) {
            $this->message2 = true;
           return back();
           //dd('no');
     }
        $appointments = new Appointment();
        $appointments->doctor_id = 1;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
       $appointments->appointment_patient=$this->appointment_patient;
        $appointments->save();
        $this->message =true;

    }



}
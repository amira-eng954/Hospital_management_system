<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

       $doctors= \App\Models\Doctor::factory()->count(30)->create();

        $appoint=Appointment::all()->random()->id;
        foreach($doctors as $doctor)
        {
            $doctor->appointment_doctor()->attach($appoint);
        }
         


    }
}

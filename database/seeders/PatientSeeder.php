<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table("patients")->delete();
        DB::table("patients")->insert([
          ['email'=>"a@a.com",'password'=>Hash::make(123),'Date_Birth'=>now(),'Phone'=>"1116771",'Gender'=>"1",'Blood_Group'=>"O+",'name'=>"Ali",'address'=>"dd"],
          ['email'=>"s@s.com.com",'password'=>Hash::make(123),'Date_Birth'=>now(),'Phone'=>"1107651",'Gender'=>"2",'Blood_Group'=>"O+",'name'=>"Amira",'address'=>"dd"],

          ['email'=>"c@c.com",'password'=>Hash::make(123),'Date_Birth'=>now(),'Phone'=>"1154678811",'Gender'=>"1",'Blood_Group'=>"O+",'name'=>"Naser",'address'=>"dd"],


        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("appointments")->insert([
            ["name"=>"السبت"],
            ["name"=>"الاحد"],
            ["name"=>"الاتنين"],
            ["name"=>"الثلاثاء"],
            ["name"=>"الاربعاء"],
            ["name"=>"الخميس"],
            ["name"=>"الجمعه"],
        ]);
    }
}

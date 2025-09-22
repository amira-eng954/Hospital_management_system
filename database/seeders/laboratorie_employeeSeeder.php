<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class laboratorie_employeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table("laboratorie_employees")->delete();
         DB::table('laboratorie_employees')->insert([
             ['name'=>'مسك','email'=>"a@a.com",'Password'=>Hash::make(123),'created_at'=>now()]
        ]);
    }
}

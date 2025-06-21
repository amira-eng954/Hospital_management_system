<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("admins")->delete();
          DB::table("admins")->insert([
            'name'=>"admin",
            'email'=>"a@a.com",
            'password'=>Hash::make(123)
        ]);
    }
    }


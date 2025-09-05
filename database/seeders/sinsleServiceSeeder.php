<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class sinsleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("services")->insert([
            ['name'=>"اشعه مقطعيه",'des'=>"jjjj",'status'=>"1",'price'=>"1234"],
            ['name'=>"كشف عادى",'des'=>"pppp",'status'=>"1",'price'=>"345"],
            ['name'=>"كشف مستعجل",'des'=>"kkkk",'status'=>"0",'price'=>"1234"]
        ]);
    }
}

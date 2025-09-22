<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
              userseeder::class,
              AppointmentSeeder::class,
              adminseeder::class,
              SectionSeeder::class,
              DoctorSeeder::class,
              ImageSeeder::class,
              sinsleServiceSeeder::class,
              PatientSeeder::class,
              RayEmployeeSeeder::class,
              laboratorie_employeeSeeder::class

        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\Employee;
use App\Models\Vehicle;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tripsCount = 500;

        Trip::factory()->count($tripsCount)->create()->each(function ($trip) {

            $employees = Employee::inRandomOrder()->take(rand(1, 3))->get();
            $trip->employees()->attach($employees);


        });
    }
}

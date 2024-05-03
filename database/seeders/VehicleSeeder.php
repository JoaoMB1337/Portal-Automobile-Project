<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('vehicles')->insert([
            'name' => 'Car',
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'Motorcycle',
            'brand' => 'Honda',
            'model' => 'CBR',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'Truck',
            'brand' => 'Ford',
            'model' => 'F-150',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'SUV',
            'brand' => 'Jeep',
            'model' => 'Wrangler',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'Van',
            'brand' => 'Chevrolet',
            'model' => 'Express',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'Bus',
            'brand' => 'Mercedes-Benz',
            'model' => 'Sprinter',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vehicles')->insert([
            'name' => 'Bicycle',
            'brand' => 'Giant',
            'model' => 'Talon',
            'year' => 2021,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}

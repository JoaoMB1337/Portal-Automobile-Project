<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FuelType;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuelTypes = array(
            'Gasolina',
            'Gasóleo',
            'Electrico',
            'Hybrido',
            'GPL',


        );



        foreach ($fuelTypes as $fuelType) {
            FuelType::create([
                "type" => $fuelType,

            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen('storage\files\states.csv', 'r');

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                District::create([
                    "name" => $data['0'],
                    "country_id" => $data['1'],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

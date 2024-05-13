<?php

namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(storage_path('files/brands.csv'), 'r');

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Brand::create([
                    "name" => $data['0'],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

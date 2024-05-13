<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DrivingLicense;


class DrivingLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DrivingLicense = array('A','B','C','CE','D');


        foreach ($DrivingLicense as $DrivingLicense) {
            DrivingLicense::create([
                "name" => $DrivingLicense,
            ]);
        }
    }
}

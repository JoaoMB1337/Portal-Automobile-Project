<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleInspectionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleInspectionStatuses = [
            'Pendente',
            'Aprovado',
            'Reprovado',
        ];

        foreach ($vehicleInspectionStatuses as $vehicleInspectionStatus) {
            \App\Models\VehicleInspectionStatus::create([
                'status_name' => $vehicleInspectionStatus,
            ]);
        }
    }
}

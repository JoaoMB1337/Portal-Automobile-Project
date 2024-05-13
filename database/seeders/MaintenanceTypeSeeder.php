<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaintenanceType;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MaintenanceTypes = [
            'Corretiva' => 'É a manutenção que ocorre após a falha de um equipamento ou sistema',
            'Preventiva' => 'É a manutenção programada do automóvel, que é feita antes de ocorrerem problemas',
            'Preditiva' => 'É baseada em sinais do automóvel que indiquem possíveis problemas que necessitem, de facto, de manutenção',
            'Detectiva' => 'É a manutenção que ocorre após a falha de um equipamento ou sistema',
        ];

        foreach ($MaintenanceTypes as $typeName => $description) {
            MaintenanceType::create([
                "type_name" => $typeName,
                "description" => $description
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectStatus;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $projectStatuses = [
        'Não Iniciado',
        'Em Progresso',
        'Concluído',
        'Cancelado',
        'Em Espera'
      ];

        foreach ($projectStatuses as $projectStatus) {
            ProjectStatus::create([
            'status_name' => $projectStatus
            ]);
        }
    }
}

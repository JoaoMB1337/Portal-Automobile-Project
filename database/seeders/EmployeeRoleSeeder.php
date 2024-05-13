<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeRole;

class EmployeeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeRoles = [
            'Administrador',
            'Gestor',
            'Empregado',
        ];

        foreach ($employeeRoles as $employeeRole) {
            EmployeeRole::create([
                'name' => $employeeRole,
            ]);
        }
    }
}

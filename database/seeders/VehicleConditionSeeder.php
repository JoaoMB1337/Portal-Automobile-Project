<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = [
            'Novo',
            'Seminovo',
            'Usado',
        ];

        foreach ($conditions as $condition) {
            \App\Models\VehicleCondition::create([
                'condition' => $condition,
            ]);
        }
    }
}

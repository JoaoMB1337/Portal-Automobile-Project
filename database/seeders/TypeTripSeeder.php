<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Viagem de serviço',
            'Deslocacao diaria',
        ];

        foreach ($types as $type) {
            \App\Models\TypeTrip::create([
                'type' => $type,
            ]);
        }
    }
}

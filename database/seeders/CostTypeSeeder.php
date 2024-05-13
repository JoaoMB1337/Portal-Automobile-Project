<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CostType;

class CostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $costtypes = array('portagens','combustivel','manutencao','limpeza','estacionamento','reparacao','multas','outros');

        foreach ($costtypes as $costtype) {
            CostType::create([
                "type_name" => $costtype,
            ]);
        }
    }
}

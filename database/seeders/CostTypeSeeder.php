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
        $costtypes = array('Aluguer','Portagens','Combustivel','Manuteção','Limpeza','Estacionamento','Reparação','Multa','Outros');

        foreach ($costtypes as $costtype) {
            CostType::create([
                "type_name" => $costtype,
            ]);
        }
    }
}

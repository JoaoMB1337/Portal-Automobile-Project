<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarCategory;

class CarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carcategories = array('Classe 1','Classe 2','Classe 3', 'Classe 4');

        foreach ($carcategories as $carcategory) {
            CarCategory::create([
                "category" => $carcategory,
            ]);
        }
    }
}

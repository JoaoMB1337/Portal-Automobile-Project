<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactType;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacttypes = array('Telemovel', 'Telefone', 'Email');

        foreach ($contacttypes as $contacttype) {
            ContactType::create([
                "type" => $contacttype,
            ]);
        }
    }
}

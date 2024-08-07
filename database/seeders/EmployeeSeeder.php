<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $faker = Faker::create();


        $employees = [
            [
                'name' => 'Admin',
                'employee_number' => '0000',
                'gender'=> 'Male',
                'birth_date' => '1999-07-15',
                'CC' => '987654321',
                'NIF' => '987654321',
                'address' => 'Rua da Atec, 123',
                'employee_role_id' => 1,
                'email' => 'admin@innodrive.com',
                'phone' => '913333459',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Diogo Sousa',
                'employee_number' => '0001',
                'gender'=> 'Male',
                'birth_date' => '1999-07-15',
                'CC' => '123456789',
                'NIF' => '123456789',
                'address' => 'Rua de baixo, 123',
                'employee_role_id' => 2,
                'email' => 'diogosousainf@gmail.com',
                'phone' => '914976204',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Joao Barbosa',
                'employee_number' => '0002',
                'gender'=> 'Male',
                'birth_date' => '2002-07-15',
                'CC' => '223456719',
                'NIF' => '123456777',
                'address' => 'Rua de cima, 123',
                'employee_role_id' => 1,
                'email' => 'jbarbosa@gmail.com',
                'phone' => '911941212',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Marcos Carvalho',
                'employee_number' => '0003',
                'gender'=> 'Male',
                'birth_date' => '1992-07-15',
                'CC' => '323456789',
                'NIF' => '123452722',
                'address' => 'Rua de rua, 123',
                'employee_role_id' => 2,
                'email' => 'mcarvalho@gmail.com',
                'phone' => '934567232',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Ismael Pinheiro',
                'employee_number' => '0004',
                'gender'=> 'Male',
                'birth_date' => '2005-07-15',
                'CC' => '423456789',
                'NIF' => '123496711',
                'address' => 'Rua de rua, 123',
                'employee_role_id' => 3,
                'email' => 'ismailov@gmail.com',
                'phone' => '911167232',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Mariza Costa',
                'employee_number' => '0005',
                'gender'=> 'Female',
                'birth_date' => '1995-07-15',
                'CC' => '523456789',
                'NIF' => '423496711',
                'address' => 'Rua de cima baixo, 123',
                'employee_role_id' => 3,
                'email' => 'mariza@gmail.com',
                'phone' => '961167232',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],

            [
                'name' => 'Ruben Canelas',
                'employee_number' => '0006',
                'gender'=> 'Male',
                'birth_date' => '1995-07-15',
                'CC' => '112233445',
                'NIF' => '544332211',
                'address' => 'Rua das ruas,123',
                'employee_role_id' => 1,
                'email' => 'ruben.canelas@innodrive.com',
                'phone' => '932123456',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Goncalo Garrido',
                'employee_number' => '0007',
                'gender'=> 'Male',
                'birth_date' => '1995-07-15',
                'CC' => '221133445',
                'NIF' => '544223311',
                'address' => 'Rua das ruas,123',
                'employee_role_id' => 1,
                'email' => 'goncalo.garrido@innodrive.com',
                'phone' => '910658166',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
            [
                'name' => 'Sara Azevedo',
                'employee_number' => '0008',
                'gender'=> 'Male',
                'birth_date' => '1995-07-15',
                'CC' => '331133445',
                'NIF' => '544331133',
                'address' => 'Rua das ruas,123',
                'employee_role_id' => 1,
                'email' => 'sara.azevedo@innodrive.com',
                'phone' => '932123496',
                'email_verified_at' => '2021-01-01',
                'password' => bcrypt('12345678'),
                'remember_token' => '123456789',
                'first_login' => false, 
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ]

        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}

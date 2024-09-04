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
                'name' => 'Joao Barbosa',
                'employee_number' => '0001',
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
                'name' => 'Ruben Canelas',
                'employee_number' => '0002',
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
                'name' => 'Funcionario1',
                'employee_number' => '0003',
                'gender'=> 'Male',
                'birth_date' => '1995-07-15',
                'CC' => '112233446',
                'NIF' => '544332261',
                'address' => 'Rua das ruas,123',
                'employee_role_id' => 3,
                'email' => 'funcionario@innodrive.com',
                'phone' => '932456709',
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

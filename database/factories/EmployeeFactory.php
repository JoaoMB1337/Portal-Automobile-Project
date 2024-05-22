<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker-> name,
            'gender' => $this-> faker->random,
            'birth_date' => $this->faker->date,
            'CC' => $this->faker->randomNumber,
            'NIF' => $this->faker->randomNumber,
            'address' => $this->faker->address,
            'employee_role_id' => $this->faker->randomNumber,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => $this->faker->date,
            'password' => $this->bcrypt('12345678'),
            'remember_token' => $this->faker->randomNumber,
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,

        ];
    }
}

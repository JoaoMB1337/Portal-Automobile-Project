<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'insurance_company' => $this->faker->company,
            'policy_number' => $this->faker->unique()->randomNumber(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'cost' => $this->faker->randomFloat(2, 100, 10000),
            'vehicle_id' => \App\Models\Vehicle::inRandomOrder()->value('id'),
        ];
    }
}

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
        // Gera a data de início do seguro
        $startDate = $this->faker->dateTimeBetween('2022-01-01', '2024-07-31')->format('Y-m-d');

        // Gera a data de término do seguro, garantindo que seja após a data de início
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 year')->format('Y-m-d');

        return [
            'insurance_company' => $this->faker->company,
            'policy_number' => $this->faker->unique()->bothify('POL-#####'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'cost' => $this->faker->randomFloat(2, 100, 10000),
            'vehicle_id' => \App\Models\Vehicle::inRandomOrder()->value('id'),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripDetail>
 */
class TripDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trip_id' => $this->faker->numberBetween(1, 500),
            'cost_type_id' => $this->faker->numberBetween(1, 5),
            'cost' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}

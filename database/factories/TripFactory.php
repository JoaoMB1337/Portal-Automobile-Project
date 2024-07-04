<?php

namespace Database\Factories;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Trip::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('2022-01-01', '2024-07-31');
        $endDate = $this->faker->dateTimeBetween($startDate, '2024-07-31');


        return [
            'start_date' => $startDate->format('Y-m-d'), // Garantindo que start_date seja sempre antes de end_date
            'end_date' => $endDate->format('Y-m-d'),
            'destination' => $this->faker->city,
            'purpose' => $this->faker->sentence,
            'project_id' => \App\Models\Project::inRandomOrder()->value('id'),
            'type_trip_id' => \App\Models\TypeTrip::inRandomOrder()->value('id'),
        ];
    }
}
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
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'destination' => $this->faker->city,
            'purpose' => $this->faker->sentence,
            'project_id' => \App\Models\Project::inRandomOrder()->value('id'),
            'type_trip_id' => \App\Models\TypeTrip::inRandomOrder()->value('id'),
        ];
    }
}

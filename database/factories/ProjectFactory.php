<?php

namespace Database\Factories;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Project::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'project_status_id' => \App\Models\ProjectStatus::inRandomOrder()->value('id'),
            'district_id' => \App\Models\District::inRandomOrder()->value('id'),
            'country_id' => \App\Models\Country::inRandomOrder()->value('id'),
        ];
    }
}

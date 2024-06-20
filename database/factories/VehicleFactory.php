<?php

namespace Database\Factories;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vehicle::class;
    public function definition(): array
    {
        $rentalStartDate = $this->faker->optional()->dateTime();
        $rentalEndDate = null;

        if ($rentalStartDate) {
            $rentalEndDate = $this->faker->dateTimeBetween($rentalStartDate, '+1 year');
        }

        return [
            'plate' => strtoupper($this->faker->bothify('???-####')),
            'km' => $this->faker->numberBetween(0, 200000),
            'is_external' => $this->faker->boolean,
            'contract_number' => $this->faker->optional()->bothify('CN-#####'),
            'rental_price_per_day' => $this->faker->optional()->randomFloat(2, 10, 1000),
            'rental_start_date' => $rentalStartDate,
            'rental_end_date' => $rentalEndDate,
            'rental_company' => $this->faker->optional()->company,
            'rental_contact_person' => $this->faker->optional()->name,
            'rental_contact_number' => $this->faker->optional()->phoneNumber,
            'notes' => $this->faker->optional()->text(50),
            'is_active' => $this->faker->boolean(false),
            'fuel_type_id' => \App\Models\FuelType::inRandomOrder()->value('id'),
            'car_category_id' => \App\Models\CarCategory::inRandomOrder()->value('id'),
            'brand_id' => \App\Models\Brand::inRandomOrder()->value('id'),
            'vehicle_condition_id' => \App\Models\VehicleCondition::inRandomOrder()->value('id'),
        ];
    }
}

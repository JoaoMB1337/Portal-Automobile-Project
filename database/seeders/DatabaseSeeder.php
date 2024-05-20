<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(CountrySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(FuelTypeSeeder::class);
        $this->call(DrivingLicenseSeeder::class);
        $this->call(CarCategorySeeder::class);
        $this->call(ContactTypeSeeder::class);
        $this->call(EmployeeRoleSeeder::class);
        $this->call(CostTypeSeeder::class);
        $this->call(ProjectStatusSeeder::class);
        $this->call(TypeTripSeeder::class);
        $this->call(VehicleConditionSeeder::class);
    }
}

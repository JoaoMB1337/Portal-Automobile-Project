<?php

namespace App\Providers;

use App\Models\Vehicle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->call(function () {
                $vehicles = Vehicle::all();

                foreach ($vehicles as $vehicle) {
                    $vehicle->updateStatus();
                }
            })->daily();
        });
    }
}

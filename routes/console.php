<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\UpdateVehicleStatus;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('vehicles:update-status', function () {
    $this->call(UpdateVehicleStatus::class);
})->purpose('Update the status of vehicles based on their rental periods and trips')->everyMinute();

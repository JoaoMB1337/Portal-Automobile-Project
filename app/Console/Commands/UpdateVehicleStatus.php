<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateVehicleStatus extends Command
{
    protected $signature = 'vehicles:update-status';
    protected $description = 'Update the status of vehicles based on their rental periods and trips';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info('DB Host: ' . env('DB_HOST'));
        Log::info('DB Database: ' . env('DB_DATABASE'));
        Log::info('DB Username: ' . env('DB_USERNAME'));
        Log::info('DB Password: ' . env('DB_PASSWORD'));
        
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $vehicle->updateStatus();
        }

        Log::info('Vehicle statuses updated successfully.');
        $this->info('Vehicle status updated successfully.');
    }
}

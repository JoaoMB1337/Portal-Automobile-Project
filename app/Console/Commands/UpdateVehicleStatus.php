<?php

namespace App\Console\Commands;

use App\Http\Controllers\VehicleController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateVehicleStatus extends Command
{
    protected $signature = 'vehicles:update-status';
    protected $description = 'Update the status of vehicles based on their rental periods and trips';

    protected $vehicleController;

    public function __construct(VehicleController $vehicleController)
    {
        parent::__construct();
        $this->vehicleController = $vehicleController;
    }

    public function handle()
    {
        $this->vehicleController->updateAllVehicleStatuses();

        $this->info('Vehicle status updated successfully.');
    }
}

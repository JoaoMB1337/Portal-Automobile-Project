<?php

namespace App\Http\Controllers;

use App\Models\VehicleMaintenance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleMaintenanceRequest;
use App\Http\Requests\UpdateVehicleMaintenanceRequest;

class VehicleMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleMaintenanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleMaintenance $vehicleMaintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleMaintenance $vehicleMaintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleMaintenanceRequest $request, VehicleMaintenance $vehicleMaintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleMaintenance $vehicleMaintenance)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\VehicleInspection;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleInspectionRequest;
use App\Http\Requests\UpdateVehicleInspectionRequest;

class VehicleInspectionController extends Controller
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
    public function store(StoreVehicleInspectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleInspection $vehicleInspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleInspection $vehicleInspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleInspectionRequest $request, VehicleInspection $vehicleInspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleInspection $vehicleInspection)
    {
        //
    }
}

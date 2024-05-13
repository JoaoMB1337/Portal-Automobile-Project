<?php

namespace App\Http\Controllers;

use App\Models\DrivingLicense;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDrivingLicenseRequest;
use App\Http\Requests\UpdateDrivingLicenseRequest;

class DrivingLicenseController extends Controller
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
    public function store(StoreDrivingLicenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DrivingLicense $drivingLicense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DrivingLicense $drivingLicense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrivingLicenseRequest $request, DrivingLicense $drivingLicense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrivingLicense $drivingLicense)
    {
        //
    }
}

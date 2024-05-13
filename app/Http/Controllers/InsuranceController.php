<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;

class InsuranceController extends Controller
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
    public function store(StoreInsuranceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurance $insurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsuranceRequest $request, Insurance $insurance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {
        //
    }
}

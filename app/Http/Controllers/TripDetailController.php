<?php

namespace App\Http\Controllers;

use App\Models\TripDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripDetailRequest;
use App\Http\Requests\UpdateTripDetailRequest;

use App\Models\Project;
use App\Models\CostType;
use App\Models\Trip;
use App\Models\Employee;

class TripDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tripDetails = TripDetail::all();
        $projects = Project::all();
        $costTypes = CostType::all();
        $trips = Trip::all();
        $employees = Employee::all();
        return view('pages.TripDetails.list', [
            'tripDetails' => $tripDetails,
            'projects' => $projects,
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all(); 
        $costTypes = CostType::all();
        $trips = Trip::all();
        $employees = Employee::all();
        
        return view('pages.TripDetails.create', [
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripDetailRequest $request)
    {
        $validated = $request->validated();
        
        $tripDetail = new TripDetail();
        $tripDetail->trip_id = $validated['trip_id'];
        $tripDetail->cost_type_id = $validated['cost_type_id'];
        $tripDetail->cost = $validated['cost'];
        $tripDetail->save();

        return redirect()->route('trip-details.index')->with('success', 'Detalhe de viagem criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TripDetail $tripDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripDetail $tripDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripDetailRequest $request, TripDetail $tripDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripDetail $tripDetail)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $trips = Trip::orderby('id','asc')->paginate(15);
        return view('pages.trips.list',['trips'=>$trips]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //Associar a trip ao employee
        $employees = Employee::all();
        return view('pages.trips.create', ['employees' => $employees]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $trip = new Trip();
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->employee_id = $request->employee_id;
        $trip->save();

        return redirect()->route('trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->employee_id = $request->employee_id;
        $trip->save();

        return redirect()->route('trips.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}

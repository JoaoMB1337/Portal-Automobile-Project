<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $trips = Trip::orderby('id','asc')->paginate(15);
        return view('pages.trips.list',['trips'=>$trips, 'project' => \App\Models\Project::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = \App\Models\Employee::all();
        $projects = \App\Models\Project::all();
        $typeTrips = \App\Models\TypeTrip::all();
        return view('pages.trips.create', ['employees' => $employees, 'projects' => $projects, 'typeTrips' => $typeTrips]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $trip = new Trip();
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->destination = $request->destination;
        $trip->purpose = $request->purpose;
        $trip->employee_id = $request->employee_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->project_id = $request->project_id;

        $trip->save();

        return redirect()->route('trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {

        return view('pages.trips.show', compact('trip'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $trip = Trip::find($trip->id);
        $employees = \App\Models\Employee::all();
        $projects = \App\Models\Project::all();
        $typeTrips = \App\Models\TypeTrip::all();
        return view('pages.trips.edit', ['trip' => $trip, 'employees' => $employees, 'projects' => $projects, 'typeTrips' => $typeTrips]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->employee_id = $request->employee_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->project_id = $request->project_id;
        $trip->save();

        return redirect()->route('trips.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index');
    }

    public function deleteSelected(Request $request)
    {
        $selected_ids = json_decode($request->input('selected_ids'),true);
        if(!empty($selected_ids)) {
            Trip::whereIn('id', $selected_ids)->delete();
            return redirect()->route('trips.index');
        }
    }
}

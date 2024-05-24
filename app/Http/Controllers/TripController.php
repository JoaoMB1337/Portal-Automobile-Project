<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Employee;
use App\Models\TypeTrip;
use App\Models\Vehicle;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::orderby('id','asc')->paginate(15);
        $employees = Employee::all();
        $projects = Project::all();
        return view('pages.trips.list',[
            'trips'=>$trips,
            'employees' => Employee::all(),
            'project' => Project::all(),
            'vehicles' => Vehicle::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $employees = Employee::all();
        $projects = Project::all();
        $typeTrips = TypeTrip::all();
        $vehicles = Vehicle::all();

        if ($search = $request->input('search')) {

            $vehicles = Vehicle::where('plate', 'like', '%' . $search . '%')->get();
        }
        return view('pages.trips.create', [
            'employees' => $employees,
            'projects' => $projects,
            'typeTrips' => $typeTrips,
            'vehicles' => $vehicles
        ]);


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
        $trip->project_id = $request->project_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->save();

        $trip->employees()->attach($request->employee_id);
        $trip->vehicles()->attach($request->vehicle_id);

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
        $employees = Employee::all();
        $projects = Project::all();
        $typeTrips = TypeTrip::all();
        $vehicles = Vehicle::all();
        return view('pages.trips.edit', [
            'trip' => $trip,
            'employees' => $employees,
            'projects' => $projects,
            'typeTrips' => $typeTrips,
            'vehicles' => $vehicles
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->destination = $request->destination;
        $trip->purpose = $request->purpose;
        $trip->project_id = $request->project_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->vehicle_id = $request->vehicle_id;
        $trip->save();

        // Atualizar associações empregado-viagem
        $trip->employees()->sync($request->employee_id);
        $trip->vehicles()->sync($request->vehicle_id);

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

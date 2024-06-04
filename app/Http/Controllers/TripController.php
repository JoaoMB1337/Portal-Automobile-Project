<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Employee;
use App\Models\TypeTrip;
use App\Models\Vehicle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Trip::query();

        if ($request->has('clear_filters')) {
            $request->session()->forget(['destination', 'project']);
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'ilike', '%' . $request->input('destination') . '%');
        }

        if ($request->filled('project')) {
            $query->whereHas('project', function ($q) use ($request) {
                $q->where('name', 'ilike', '%' . $request->input('project') . '%');
            });
        }

        $trips = $query->orderBy('id', 'asc')->paginate(15);

        return view('pages.Trips.list', [
            'trips' => $trips,
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

        $project_id = $request->input('project_id');

        $employees = Employee::all();
        $projects = Project::all();
        $typeTrips = TypeTrip::all();
        $vehicles = Vehicle::all();

        if ($search = $request->input('search')) {

            $vehicles = Vehicle::where('plate', 'like', '%' . $search . '%')->get();
        }
        return view('pages.Trips.create', [
            'employees' => $employees,
            'projects' => $projects,
            'typeTrips' => $typeTrips,
            'vehicles' => $vehicles,
            'project_id' => $project_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        \Log::info('Request Data:', $request->all());

        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'type_trip_id' => 'required|exists:type_trips,id',
            'employee_id' => 'required|exists:employees,id',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);

        $trip = new Trip();
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->destination = $request->destination;
        $trip->purpose = $request->purpose;
        $trip->project_id = $request->project_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->save();


        /*
            O QUE ESTAVA ANTES

            $trip->employees()->attach($request->employee_id);
            $trip->vehicles()->attach($request->vehicle_id);
        */

        /* ADICIONEI*/
        $trip->employees()->attach($validatedData['employee_id']);
        $trip->vehicles()->attach($validatedData['vehicle_id']);

        return redirect()->route('trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {

        $totalCost = $trip->tripDetails->sum('cost');
        return view('pages.Trips.show', [
            'trip' => $trip,
            'employees' => $trip->employees,
            'vehicles' => $trip->vehicles,
            'tripDetails' => $trip->tripDetails,
            'projects' => Project::all(),
            'costTypes' => CostType::all(),
            'totalCost' => $totalCost,
        ]);
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
        return view('pages.Trips.edit', [
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

    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->start_date = $request->start_date;
        $trip->end_date = $request->end_date;
        $trip->destination = $request->destination;
        $trip->purpose = $request->purpose;
        $trip->project_id = $request->project_id;
        $trip->type_trip_id = $request->type_trip_id;
        $trip->save();

        $trip->employees()->sync([$request->employee_id]);
        $trip->vehicles()->sync([$request->vehicle_id]);

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
        $ids = $request->input('selected_ids', []);
        Trip::whereIn('id', $ids)->delete();
        return redirect()->route('trips.index')->with('success', 'Viagem excluídos com sucesso.');
    }
}

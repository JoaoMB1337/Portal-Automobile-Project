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

        $trips = $query->orderBy('id', 'asc')->paginate(10);

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

        $validatedData = $request->validated();

        $trip = new Trip();
        $trip->start_date = $validatedData['start_date'] ?? null;
        $trip->end_date = $validatedData['end_date'];
        $trip->destination = $validatedData['destination'];
        $trip->purpose = $validatedData['purpose'];
        $trip->project_id = $validatedData['project_id'];
        $trip->type_trip_id = $validatedData['type_trip_id'];
        $trip->save();

        if (isset($validatedData['employee_id'])) {
            $trip->employees()->attach($validatedData['employee_id']);
        }

        if (isset($validatedData['vehicle_id'])) {
            $trip->vehicles()->attach($validatedData['vehicle_id']);
        }

        // /* ADICIONEI*/
        // $trip->employees()->attach($validatedData['employee_id']);
        // $trip->vehicles()->attach($validatedData['vehicle_id']);

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
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
            'project_id' => 'required|integer|exists:projects,id',
            'type_trip_id' => 'required|integer|exists:type_trips,id',
            'employee_id' => 'nullable|integer|exists:employees,id',
            'vehicle_id' => 'nullable|integer|exists:vehicles,id',
        ]);

        if ($validatedData['end_date'] < $validatedData['start_date']) {
            return redirect()->back()->withInput()->withErrors(['end_date' => 'A data de fim deve ser posterior à data de início.']);
        }

        $trip = Trip::findOrFail($id);

        $trip->start_date = $validatedData['start_date'];
        $trip->end_date = $validatedData['end_date'];
        $trip->destination = $validatedData['destination'];
        $trip->purpose = $validatedData['purpose'];
        $trip->project_id = $validatedData['project_id'];
        $trip->type_trip_id = $validatedData['type_trip_id'];
        $trip->save();

        if (isset($validatedData['employee_id'])) {
            $trip->employees()->sync([$validatedData['employee_id']]);
        }

        if (isset($validatedData['vehicle_id'])) {
            $trip->vehicles()->sync([$validatedData['vehicle_id']]);
        }

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

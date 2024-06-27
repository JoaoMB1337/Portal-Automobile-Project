<?php

namespace App\Http\Controllers;

use App\Models\TripDetail;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripDetailRequest;
use App\Http\Requests\UpdateTripDetailRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Project;
use App\Models\CostType;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TripDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', TripDetail::class);

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
    public function create(Request $request)
    {
        $projects = Project::all();
        $costTypes = CostType::all();
        $trips = Trip::all();
        $employees = Employee::all();
        $tripId = $request->input('trip_id');


        return view('pages.TripDetails.create', [
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees,
            'tripId' => $tripId,
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

        $trip = Trip::findOrFail($validated['trip_id']);
        $project = $trip->project;
        $directory = 'projects/' . $project->id . '/trips/' . $tripDetail->trip_id . '/receipts';

        if ($request->hasFile('receipt_gallery')) {
            $request->validate([
                'receipt_gallery' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('receipt_gallery');
            $fileName = hash('sha256', time() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($directory, $fileName, 'public');
            $tripDetail->file = $fileName;
        } elseif ($request->hasFile('receipt_camera')) {
            $request->validate([
                'receipt_camera' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('receipt_camera');
            $fileName = hash('sha256', time() . '_' . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($directory, $fileName, 'public');
            $tripDetail->file = $fileName;
        }

        $tripDetail->save();

        return redirect()->route('trips.show', ['trip' => $trip->id])->with('success', 'Detalhe de viagem criado com sucesso!');
    }

    



    /**
     * Display the specified resource.
     */
    public function show(TripDetail $tripDetail)
    {
        try {
            $this->authorize('view', $tripDetail);

            $trip = $tripDetail->trip;
            $project = $trip->project;

            return view('pages.TripDetails.show', [
                'tripDetail' => $tripDetail,
                'trip' => $trip,
                'project' => $project
            ]);
        } catch (AuthorizationException $e) {
            // Redirecionar para a página de erro 403 personalizada
            return redirect()->route('error.403');
        }
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

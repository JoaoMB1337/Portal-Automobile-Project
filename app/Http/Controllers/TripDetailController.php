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
        try{
            $tripId = $request->input('trip_id');
            $trip = Trip::findOrFail($tripId);
    
            $this->authorize('create', [TripDetail::class, $trip]);
    
            $projects = Project::all();
            $costTypes = CostType::all();
            $trips = Trip::all();
            $employees = Employee::all();
    
            return view('pages.TripDetails.create', [
                'costTypes' => $costTypes,
                'trips' => $trips,
                'employees' => $employees,
                'tripId' => $tripId,
            ]);
        }
        catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para criar uma viagem.');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripDetailRequest $request)
    {
        try{
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

        return redirect()->route('trips.show', ['trip' => $trip->id])->with('success', 'Custo de '.$tripDetail->costType->type_name.' adicionado com sucesso!');
        }
        catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para criar uma viagem.');
        }
        
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
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para visualizar uma viagem.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripDetail $tripDetail)
    {
        try {
            $this->authorize('update', $tripDetail);

            $projects = Project::all();
            $costTypes = CostType::all();
            $trips = Trip::all();
            $employees = Employee::all();

            return view('pages.TripDetails.edit', [
                'tripDetail' => $tripDetail,
                'projects' => $projects,
                'costTypes' => $costTypes,
                'trips' => $trips,
                'employees' => $employees,
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para editar uma viagem.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripDetailRequest $request, TripDetail $tripDetail)
    {
        try {
            $this->authorize('update', $tripDetail);

            $validated = $request->validated();

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

            return redirect()->route('trips.show', ['trip' => $trip->id])->with('success', 'Detalhe de viagem atualizado com sucesso!');
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para editar uma viagem.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripDetail $tripDetail)
    {
        //
    }
}

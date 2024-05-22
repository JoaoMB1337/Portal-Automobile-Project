<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCostTypeRequest;
use App\Http\Requests\UpdateCostTypeRequest;
use App\Models\TripDetail;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class CostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $query = CostType::with(['tripDetails.trip.project', 'tripDetails.trip.employees']);

        // Filtrar apenas os tipos de custo que têm associações válidas
        $query->whereHas('tripDetails.trip.project')
              ->whereHas('tripDetails.trip.employees');

        $costTypes = $query->orderBy('id', 'asc')->paginate(15);

        return view('pages.CostTypes.list', [
            'costTypes' => $costTypes,
            'projects' => Project::all(),
            'employees' => Employee::all(),
            'tripDetails' => TripDetail::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $projects = Project::with(['trips.employees'])->get();
        $costTypes = CostType::all();
        $employees = Employee::all();
        return view('pages.CostTypes.create',[
            'projects' => $projects,
            'costTypes' => $costTypes,
            'employees' => $employees
            

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCostTypeRequest $request)
    {

           // Validar os dados antes de criar
           $validated = $request->validated();
        
           $costType = CostType::create([
               'type_name' => $validated['type_name'],
               'project_id' => $validated['project_id'],
               'total_cost' => $validated['total_cost'],
           ]);
   
           return redirect()->route('costs-types.index');
       }

    /**
     * Display the specified resource.
     */
    public function show(CostType $costType)
    {

        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostType $costType)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostTypeRequest $request, CostType $costType)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostType $costType)
    {
       
    }

    public function deleteSelected(Request $request)
    {
        $selected_ids = json_decode($request->input('selected_ids'), true);
        if (!empty($selected_ids)) {
            CostType::whereIn('id', $selected_ids)->delete();
            return redirect()->route('costs-types.index');
        }
    }

    
}
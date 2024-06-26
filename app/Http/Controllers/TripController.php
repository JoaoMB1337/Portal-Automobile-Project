<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use App\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Project;
use App\Models\Employee;
use App\Models\TypeTrip;
use App\Models\Vehicle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class TripController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $isAdmin = Auth::user()->isMaster();

            $query = Trip::query();

            if (!$isAdmin) {
                $employeeId = Auth::id();
                $query->whereHas('employees', function ($query) use ($employeeId) {
                    $query->where('employees.id', $employeeId);
                });
            }

            if ($request->filled('destination')) {
                $query->where('destination', 'ilike', '%' . $request->input('destination') . '%');
            }

            if ($request->filled('project')) {
                $query->whereHas('project', function ($q) use ($request) {
                    $q->where('name', 'ilike', '%' . $request->input('project') . '%');
                });
            }

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                $query->where('start_date', '>=', $startDate)
                    ->where('end_date', '<=', $endDate);
            } elseif ($request->filled('start_date')) {
                $startDate = $request->input('start_date');
                $query->where('start_date', '>=', $startDate);
            } elseif ($request->filled('end_date')) {
                $endDate = $request->input('end_date');
                $query->where('end_date', '<=', $endDate);
            }

            $trips = $query->orderBy('id', 'asc')->paginate(10)->appends($request->query());

            return view('pages.Trips.list', [
                'trips' => $trips,
                'employees' => Employee::all(),
                'project' => Project::all(),
                'vehicles' => Vehicle::all(),
            ]);
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $this -> authorize('create', Trip::class);

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
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para criar uma viagem.');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
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

        $vehicle = Vehicle::find($validatedData['vehicle_id']);
        $vehicle->is_active = true;
        $vehicle->save();

        // se o veiculo estiver ativo, não pode ser associado a outra viagem
         if (!$vehicle->is_active) {
             return redirect()->back()->withInput()->withErrors(['vehicle_id' => 'Veículo já está em uso.']);
         }

         // o veiculo para inativo quando passar a data do fim da viagem
            if ($trip->end_date < now()) {
                $vehicle->is_active = false;
                $vehicle->save();
            }

        return redirect()->route('trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            // Validate that $id is an integer
            if (!is_numeric($id) || intval($id) <= 0) {
                abort(400, 'Invalid trip ID');
            }

            // Fetch the trip by ID
            $trip = Trip::findOrFail($id);

            // Authorization check
            $this->authorize('view', $trip);

            $isAdminOrManager = Auth::user()->isMaster();

            if (!$isAdminOrManager) {
                $employeeId = Auth::id();
                $isAssociated = $trip->employees->contains($employeeId);

                if (!$isAssociated) {
                    abort(403, 'Access denied');
                }
            }

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
        } catch (QueryException $e) {
            // Handle database query exceptions
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (NotFoundHttpException $e) {
            // Handle not found exceptions
            return redirect()->route('error.403')->with('error', 'Trip not found.');
        } catch (\Exception $e) {
            // Handle all other exceptions
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        try{
            $this->authorize('update', $trip);
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
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para editar essa viagem.');
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Validação dos dados
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

        // Verificação da data de fim
        if ($validatedData['end_date'] < $validatedData['start_date']) {
            return redirect()->back()->withInput()->withErrors(['end_date' => 'A data de fim deve ser posterior à data de início.']);
        }

        // Recuperar a viagem e atualizar os dados
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


            $vehicle = Vehicle::find($validatedData['vehicle_id']);
            if ($vehicle) {


                $vehicle->is_active = true;
                $vehicle->save();



            } else {
                return redirect()->back()->withInput()->withErrors(['vehicle_id' => 'Veículo não encontrado.']);
            }
        }


        if ($trip->end_date < now()) {
            if (isset($vehicle)) {
                $vehicle->is_active = false;
                $vehicle->save();


            }
        }

        return redirect()->route('trips.index');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        try{
            $this -> authorize('delete', $trip);
            $trip->delete();
            return redirect()->route('trips.index');
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para excluir essa viagem.');
        }

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('selected_ids', []);
        Trip::whereIn('id', $ids)->delete();
        return redirect()->route('trips.index')->with('success', 'Viagem excluídos com sucesso.');
    }
}

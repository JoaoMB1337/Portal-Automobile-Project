<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\QueryException;

class InsuranceController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Insurance::class);

            $query = Insurance::query();

            if ($request->filled('insurance_company')) {
                $query->where('insurance_company', 'like', '%' . $request->input('insurance_company') . '%');
            }

            if ($request->filled('policy_number')) {
                $query->where('policy_number', 'like', '%' . $request->input('policy_number') . '%');
            }

            if ($request->has('expired')) {
                $query->where('end_date', '<', Carbon::now());
            }

            if ($request->has('ativo')) {
                if ($request->input('ativo') == '1') {
                    $query->where('end_date', '>=', Carbon::now());
                } elseif ($request->input('ativo') == '0') {
                    $query->where('end_date', '<', Carbon::now());
                }
            }

            if ($request->has('terminando')) {
                $endDateLimit = Carbon::now()->addDays(30); // Ajustado para 30 dias conforme o label do checkbox
                $query->whereBetween('end_date', [Carbon::now(), $endDateLimit]);
            }

            if ($request->has('ending_today')) {
                $query->whereDate('end_date', Carbon::today());
            }

            $insurances = $query->orderBy('id', 'asc')->paginate(10)->appends($request->query());

            return view('pages.Insurance.list', ['insurance' => $insurances, 'vehicles' => Vehicle::all()]);
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'Erro ao buscar os seguros.');
        }
    }

    public function create()
    {
        try {
            $this->authorize('create', Insurance::class);
            $vehicles = Vehicle::all();

            return view('pages.Insurance.create',
                [
                    'vehicles' => $vehicles
                ]
            );
        }catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para excluir esse funcionário.');
        }
    }

    public function store(StoreInsuranceRequest $request)
    {
        $vehicle = Vehicle::where('plate', $request->vehicle_plate)->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Veículo com a matricula fornecida não encontrado.');
        }

        if ($this->hasOverlappingInsurance($vehicle->id, $request->start_date, $request->end_date)) {
            return redirect()->back()->with('error', 'Veículo já possui um seguro ativo dentro do período fornecido.');
        }

        $insurance = new Insurance();

        $insurance->insurance_company = $request->insurance_company;
        $insurance->policy_number = $request->policy_number;
        $insurance->start_date = $request->start_date;
        $insurance->end_date = $request->end_date;
        $insurance->cost = str_replace(',', '.', str_replace('.', '', $request->cost));
        $insurance->vehicle_id = $vehicle->id;

        $insurance->save();

        return redirect()->route('insurances.index')->with('success', 'Seguro criado com sucesso.');
    }

    public function show($id)
    {
        try {
            if (!is_numeric($id) || intval($id) <= 0) {
                return redirect()->route('error.403')->with('error', 'Invalid insurance ID.');
            }

            $insurance = Insurance::findOrFail($id);

            $this->authorize('view', $insurance);

            return view('pages.Insurance.show', compact('insurance'));
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Unauthorized access.');
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    public function edit(Insurance $insurance)
    {
        try {
            $this->authorize('update', $insurance);

            return view('pages.Insurance.edit', compact('insurance'));
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Unauthorized access.');
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    public function update(Request $request, Insurance $insurance)
    {
        $vehicle = Vehicle::where('plate', $request->vehicle_plate)->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Veículo com a placa fornecida não encontrado.');
        }

        if ($this->hasOverlappingInsurance($vehicle->id, $request->start_date, $request->end_date, $insurance->id)) {
            return redirect()->back()->with('error', 'Veículo já possui um seguro ativo dentro do período fornecido.');
        }

        $insurance->update([
            'insurance_company' => $request->insurance_company,
            'policy_number' => $request->policy_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cost' => str_replace(',', '.', str_replace('.', '', $request->cost)),
            'vehicle_id' => $vehicle->id
        ]);

        return redirect()->route('insurances.index')->with('message', 'Seguro atualizado com sucesso.');
    }

    public function destroy(Insurance $insurance)
    {
        try {
            $this->authorize('delete', $insurance);

            $insurance->delete();
            return redirect()->route('insurances.index')->with('error', 'Seguro excluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para excluir esse funcionário.');
        }
    }

    public function deleteSelected(Request $request)
    {
        if ($request->has('selected_ids')) {
            if (!empty($request->selected_ids)) {
                Insurance::whereIn('id', $request->selected_ids)->delete();
            }
        }

        return redirect()->route('insurances.index')->with('error', 'Seguros excluidos com sucesso.');
    }

    private function hasOverlappingInsurance($vehicleId, $startDate, $endDate, $excludeId = null)
    {
        $query = Insurance::where('vehicle_id', $vehicleId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}

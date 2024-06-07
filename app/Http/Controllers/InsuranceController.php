<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class InsuranceController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Insurance::class);

        // Obtém todos os seguros
        $query = Insurance::query();

        // Filtra por companhia de seguro, se fornecido
        if ($request->filled('insurance_company')) {
            $query->where('insurance_company', 'like', '%' . $request->input('insurance_company') . '%');
        }

        // Filtra por número da apólice, se fornecido
        if ($request->filled('policy_number')) {
            $query->where('policy_number', 'like', '%' . $request->input('policy_number') . '%');
        }

        // Filtra por seguros expirados
        if ($request->has('expired')) {
            $query->where('end_date', '<', Carbon::now());
        }

        // Filtra por seguros ativos ou inativos com base na data de término
        if ($request->has('ativo')) {
            if ($request->input('ativo') == '1') {
                $query->where('end_date', '>=', Carbon::now());
            } elseif ($request->input('ativo') == '0') {
                $query->where('end_date', '<', Carbon::now());
            }
        }

        // Ordena por ID em ordem ascendente e paginates os resultados
        $insurances = $query->orderBy('id', 'asc')->paginate(15);

        return view('pages.Insurance.list', ['insurance' => $insurances]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Insurance::class);

        return view('pages.Insurance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuranceRequest $request)
    {
        // Encontrar o veículo com base na matrícula fornecida
        $vehicle = Vehicle::where('plate', $request->vehicle_plate)->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Vehicle with the provided plate not found.');
        }

        $insurance = new Insurance();

        $insurance->insurance_company = $request->insurance_company;
        $insurance->policy_number = $request->policy_number;
        $insurance->start_date = $request->start_date;
        $insurance->end_date = $request->end_date;
        //$insurance->cost = $request->cost;

        $insurance->cost = str_replace(',', '.', str_replace('.', '', $request->cost));

        //$insurance->cost = str_replace(',', '.', $insurance->cost);


        $insuranceExists = Insurance::where('vehicle_id', $vehicle->id)->first();
        if ($insuranceExists) {
            return redirect()->back()->with('error', 'Veiculo ja tem seguro.');
        }



        // Associar o veículo encontrado ao seguro
        $insurance->vehicle_id = $vehicle->id;

        $insurance->save();

        return redirect()->route('insurances.index')->with('success', 'Insurance created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {
        $this->authorize('view', $insurance);

        return view('pages.Insurance.show', compact('insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurance $insurance)
    {

        $this->authorize('update', $insurance);

        return view('pages.Insurance.edit', compact('insurance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insurance $insurance)
    {
        $request->validate([
            'insurance_company' => 'required|string',
            'policy_number' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            //'cost' => 'required|numeric',
            'cost' => ['required', 'regex:/^\d{1,3}(\.\d{3})*(\,\d{2})?$/'],
            'vehicle_plate' => 'required|exists:vehicles,plate'
        ]);


        $vehicle = Vehicle::where('plate', $request->vehicle_plate)->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Vehicle with the provided plate not found.');
        }

        $insurance->update([
            'insurance_company' => $request->insurance_company,
            'policy_number' => $request->policy_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            //'cost' => $request->cost,
            'cost' => str_replace(',', '.', str_replace('.', '', $request->cost)),

            'vehicle_id' => $vehicle->id
        ]);

        return redirect()->route('insurances.index')->with('success', 'Insurance updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {

        $this->authorize('delete', $insurance);

        $insurance->delete();
        return redirect()->route('insurances.index');
    }

    public function deleteSelected(Request $request)
    {

        if ($request->has('selected_ids')) {



            if (!empty($request->selected_ids)) {

                Insurance::whereIn('id', $request->selected_ids)->delete();
            }
        }


        return redirect()->route('insurances.index');
    }
}
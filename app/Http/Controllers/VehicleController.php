<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\FuelType;
use App\Models\CarCategory;
use App\Models\VehicleCondition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\error;

class VehicleController extends Controller
{
    use AuthorizesRequests;
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Vehicle::class);

            $query = Vehicle::query();

            if ($search = $request->input('search')) {
                $query->where('plate', 'ilike', '%' . $search . '%');
            }

            if (($isExternal = $request->input('is_external')) !== null) {
                if ($isExternal === '0' || $isExternal === '1') {
                    $query->where('is_external', $isExternal);
                }
            }

            if ($fuelTypeId = $request->input('fuel_type')) {
                $query->where('fuel_type_id', $fuelTypeId);
            }

            if (($vehicleNotUsed = $request->input('filter_activity')) !== null) {
                if ($vehicleNotUsed === '1') {
                    $query->where('is_active', 1);
                } elseif ($vehicleNotUsed === '0') {
                    $query->where('is_active', 0);
                }
            }

            if ($rentalExpired = $request->input('rental_expired')) {
                if ($rentalExpired == '1') {
                    $query->where('is_external', 1)
                        ->where('rental_end_date', '<', now());
                }
            } else {
                $query->where(function ($query) {
                    $query->where('is_external', 0)
                        ->orWhere(function ($query) {
                            $query->where('is_external', 1)
                                ->where('rental_end_date', '>=', now());
                        });
                });
            }

            // Pagination with descending order
            $vehicles = $query->orderBy('id', 'desc')->paginate(15);

            // Get all fuel types for the filter dropdown
            $fuelTypes = FuelType::all();

            return view('pages.Vehicles.list', compact('vehicles', 'fuelTypes'));
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para visualizar veículos.');
        }
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('create', Vehicle::class);

            $brands = Brand::all();
            $fuelTypes = FuelType::all();
            $carCategories = CarCategory::all();
            $vehicleCondition = VehicleCondition::all();


            return view('pages.Vehicles.create', [
                'brands' => $brands,
                'fuelTypes' => $fuelTypes,
                'carCategories' => $carCategories,
                'vehicleCondition' => $vehicleCondition
            ]);
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para criar uma viagem.');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        try {
            Log::info('Iniciando o processo de armazenamento de um novo veículo.');

            $vehicle = new Vehicle();
            $vehicle->plate = $request->plate;
            $vehicle->km = $request->km;
            $vehicle->vehicle_condition_id = $request->condition;
            $vehicle->is_external = $request->is_external;
            $vehicle->fuel_type_id = $request->fuelTypes;
            $vehicle->car_category_id = $request->carCategory;
            $vehicle->brand_id = $request->brand;
            $vehicle->passenger_quantity = $request->passengers;

            if ($request->is_external == null) {
                $vehicle->is_external = 0;
            }

            // Preenchendo os dados adicionais se o veículo for externo
            if ($request->is_external) {
                $vehicle->contract_number = $request->contract_number;
                $rental_price_per_day = str_replace(',', '.', $request->rental_price_per_day);
                $vehicle->rental_price_per_day = $rental_price_per_day;
                $vehicle->rental_start_date = $request->rental_start_date;
                $vehicle->rental_end_date = $request->rental_end_date;
                $vehicle->rental_company = $request->rental_company;
                $vehicle->rental_contact_person = $request->rental_contact_person;
                $vehicle->rental_contact_number = $request->rental_contact_number;

                // Salvar o arquivo PDF se existir
                if ($request->hasFile('pdf_file')) {
                    $pdf = $request->file('pdf_file');
                    $pdfPath = $pdf->storeAs('pdfs', $request->plate . '.' . $pdf->getClientOriginalExtension(), 'public');
                    $vehicle->pdf_file = $pdfPath;
                }
            } else {
                // Se não for externo, limpar os campos relacionados
                $vehicle->contract_number = null;
                $vehicle->rental_price_per_day = null;
                $vehicle->rental_start_date = null;
                $vehicle->rental_end_date = null;
                $vehicle->rental_company = null;
                $vehicle->rental_contact_person = null;
                $vehicle->rental_contact_number = null;
            }

            $vehicle->save();

            Log::info('Veículo armazenado com sucesso.');

            return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
        } catch (QueryException $e) {
            Log::error('Erro ao armazenar veículo: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Erro inesperado ao armazenar veículo: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            if (!is_numeric($id) || intval($id) <= 0) {
                return redirect()->route('error.403')->with('error', 'Invalid vehicle ID.');
            }

            $vehicle = Vehicle::findOrFail($id);

            $this->authorize('view', $vehicle);

            return view('pages.Vehicles.show', compact('vehicle'));
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Unauthorized access.');
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            // Handle all other exceptions
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request, $id)
    {
        try {
            if (!is_numeric($id) || intval($id) <= 0) {
                return redirect()->route('error.403')->with('error', 'Invalid vehicle ID.');
            }

            $vehicle = Vehicle::findOrFail($id);

            $this->authorize('update', $vehicle);

            $brands = Brand::all();
            $fuelTypes = FuelType::all();
            $carCategories = CarCategory::all();
            $vehicleCondition = VehicleCondition::all();

            return view('pages.Vehicles.edit', [
                'vehicle' => $vehicle,
                'brands' => $brands,
                'fuelTypes' => $fuelTypes,
                'carCategories' => $carCategories,
                'vehicleCondition' => $vehicleCondition,
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Unauthorized access.');
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->plate = $request->plate;
        $vehicle->km = $request->km;
        $vehicle->vehicle_condition_id = $request->condition;
        $vehicle->fuel_type_id = $request->fuel_type_id;
        $vehicle->car_category_id = $request->car_category_id;
        $vehicle->brand_id = $request->brand;
        $vehicle->passenger_quantity = $request->passenger_quantity;

        if ($vehicle->is_external) {
            $vehicle->contract_number = $request->contract_number;
            $vehicle->rental_price_per_day = $request->rental_price_per_day;
            $vehicle->rental_start_date = $request->rental_start_date;
            $vehicle->rental_end_date = $request->rental_end_date;
            $vehicle->rental_company = $request->rental_company;
            $vehicle->rental_contact_person = $request->rental_contact_person;
            $vehicle->rental_contact_number = $request->rental_contact_number;

            if ($request->hasFile('pdf_file')) {
                if ($vehicle->pdf_file) {
                    Storage::disk('public')->delete($vehicle->pdf_file);
                }

                $pdf = $request->file('pdf_file');
                $pdfPath = $pdf->storeAs('pdfs', $request->plate . '.' . $pdf->getClientOriginalExtension(), 'public');
                $vehicle->pdf_file = $pdfPath;
            }
        } else {
            $vehicle->contract_number = null;
            $vehicle->rental_price_per_day = null;
            $vehicle->rental_start_date = null;
            $vehicle->rental_end_date = null;
            $vehicle->rental_company = null;
            $vehicle->rental_contact_person = null;
            $vehicle->rental_contact_number = null;

            if ($vehicle->pdf_file) {
                Storage::disk('public')->delete($vehicle->pdf_file);
                $vehicle->pdf_file = null;
            }
        }

        $vehicle->save();

        // Redirect with success message
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try{
            $this->authorize('delete', $vehicle);
            $vehicle->delete();
            return redirect()->route('vehicles.index');
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para criar uma viagem.');
        }

    }

    public function downloadPdf(Vehicle $vehicle)
    {
        if ($vehicle->pdf_file) {
            $pdfPath = $vehicle->pdf_file;
            return Storage::disk('public')->download($pdfPath);
        } else {
            // Usando session()->flash() para passar a mensagem de erro para a view
            session()->flash('error', 'No PDF file found for this vehicle.');
            return redirect()->back(); // Redireciona para a página anterior
        }
    }

    public function deleteSelected(Request $request)
    {

        if ($request->has('selected_ids')) {

            if (!empty($request->selected_ids)) {

                Vehicle::whereIn('id', $request->selected_ids)->delete();
            }
        }
        return redirect()->route('vehicles.index');
    }

}

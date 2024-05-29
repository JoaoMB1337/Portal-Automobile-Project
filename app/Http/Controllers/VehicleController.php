<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\FuelType;
use App\Models\CarCategory;
use App\Models\VehicleCondition;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Search by plate
        if ($search = $request->input('search')) {
            $query->where('plate', 'ilike', '%' . $search . '%');
        }

        if (($isExternal = $request->input('is_external')) !== null) {

            if ($isExternal === '0' || $isExternal === '1') {
                $query->where('is_external', $isExternal);

            }
        }

        // Filter by fuel type
        if ($fuelTypeId = $request->input('fuel_type')) {
            $query->where('fuel_type_id', $fuelTypeId);
        }

        // Pagination
        $vehicles = $query->orderBy('id', 'asc')->paginate(15);

        // Get all fuel types for the filter dropdown
        $fuelTypes = FuelType::all();

        return view('pages.Vehicles.list', compact('vehicles', 'fuelTypes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|string|max:255',
            'km' => 'required|numeric|min:0',
            'condition' => 'required|exists:vehicle_conditions,id',
            'is_external' => 'nullable|boolean',
            'fuelTypes' => 'required|exists:fuel_types,id',
            'carCategory' => 'required|exists:car_categories,id',
            'brand' => 'required|exists:brands,id',
            'rental_price_per_day' => [
                'nullable',
                'regex:/^\d{1,6}([.,]\d{1,2})?$/',
            ],
            'contract_number' => 'nullable|string|max:255',
            'rental_start_date' => 'nullable|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'rental_company' => 'nullable|string|max:255',
            'rental_contact_person' => 'nullable|string|max:255',
            'rental_contact_number' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $vehicle = new Vehicle();
        $vehicle->plate = $request->plate;
        $vehicle->km = $request->km;
        $vehicle->vehicle_condition_id = $request->condition;
        $vehicle->is_external = $request->is_external;
        $vehicle->fuel_type_id = $request->fuelTypes;
        $vehicle->car_category_id = $request->carCategory;
        $vehicle->brand_id = $request->brand;

        if($request->is_external == null) {
            $vehicle->is_external = 0;
        }

        if ($request->is_external) {
            $vehicle->contract_number = $request->contract_number;
            $rental_price_per_day = str_replace(',', '.', $request->rental_price_per_day);
            $vehicle->rental_price_per_day = $rental_price_per_day;
            $vehicle->rental_start_date = $request->rental_start_date;
            $vehicle->rental_end_date = $request->rental_end_date;
            $vehicle->rental_company = $request->rental_company;
            $vehicle->rental_contact_person = $request->rental_contact_person;
            $vehicle->rental_contact_number = $request->rental_contact_number;

            if ($request->hasFile('pdf_file')) {
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
        }

        $vehicle->save();

        return redirect()->route('vehicles.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('pages.Vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $carCategories = CarCategory::all();
        $vehicleCondition = VehicleCondition::all();
        return view('pages.Vehicles.edit', [
            'vehicle' => $vehicle,
            'brands' => $brands,
            'fuelTypes' => $fuelTypes,
            'carCategories' => $carCategories,
            'vehicleCondition' => $vehicleCondition
        ]);
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
        $vehicle->delete();
        return redirect()->route('vehicles.index');
    }

    public function downloadPdf(Vehicle $vehicle)
    {
        if ($vehicle->pdf_file) {
            $pdfPath = $vehicle->pdf_file;
            return Storage::disk('public')->download($pdfPath);
        } else {
            return back()->withError('Este veículo não possui um PDF associado.');
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



    public function showVehicles()
    {
        $vehicles = Vehicle::all();
        return view('pages.Vehicles.list', compact('vehicles'));
    }
}

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
use Illuminate\Support\Facades\Storage;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::orderby('id','asc')->paginate(15);
        return view('pages.vehicles.list',['vehicles'=>$vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $carCategories = CarCategory::all();
        return view('pages.vehicles.create', ['brands' => $brands, 'fuelTypes' => $fuelTypes, 'carCategories' => $carCategories]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = new Vehicle();
        $vehicle->plate = $request->plate;
        $vehicle->km = $request->km;
        $vehicle->condition = $request->condition;
        $vehicle->is_external = $request->is_external;
        $vehicle->fuel_type_id = $request->fuelTypes;
        $vehicle->car_category_id = $request->carCategory;
        $vehicle->brand_id = $request->brand;

        if ($request->is_external) {
            $vehicle->contract_number = $request->contract_number;
            $vehicle->rental_price_per_day = $request->rental_price_per_day;
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
        return view('pages.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        $fuelTypes = FuelType::all();
        $carCategories = CarCategory::all();
        return view('pages.vehicles.edit', ['vehicle' => $vehicle, 'brands' => $brands, 'fuelTypes' => $fuelTypes, 'carCategories' => $carCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        if ($request->hasFile('pdf_file')) {
            Storage::disk('public')->delete($vehicle->pdf_file);
            $pdf = $request->file('pdf_file');
            $pdfPath = $pdf->storeAs('pdfs', $request->plate . '.' . $pdf->getClientOriginalExtension(), 'public');
            $vehicle->pdf_file = $pdfPath;
        } elseif ($request->has('current_pdf')) {
            $vehicle->pdf_file = $request->input('current_pdf');
        } else {
            Storage::disk('public')->delete($vehicle->pdf_file);
            $vehicle->pdf_file = null;
        }
        $vehicle->save();

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
        // Verifica se o veículo tem um arquivo PDF associado
        if ($vehicle->pdf_file) {
            // Obtém o caminho do arquivo PDF
            $pdfPath = $vehicle->pdf_file;

            // Retorna o arquivo PDF para download
            return Storage::disk('public')->download($pdfPath);
        } else {
            // Se não houver PDF associado, redirecione ou retorne uma mensagem de erro
            return back()->withError('Este veículo não possui um PDF associado.');
        }
    }

    public function deleteSelected(Request $request)
    {
        $selected_ids = json_decode($request->input('selected_ids'), true);
        if (!empty($selected_ids)) {
            Vehicle::whereIn('id', $selected_ids)->delete();
            return redirect()->route('vehicles.index');
        }
    }
}

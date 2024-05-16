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
        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index');
    }
}

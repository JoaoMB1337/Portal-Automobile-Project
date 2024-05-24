@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.vehicles.edit-vehicles', [
            'vehicle' => $vehicle, 
            'brands' => $brands, 
            'carCategories' => $carCategories, 
            'fuelTypes' => $fuelTypes,
            'vehicleCondition' => $vehicleCondition,
            ])
        @endcomponent
    </div>
@endsection

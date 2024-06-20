@extends('components.Master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Vehicles.edit-vehicles', [
            'vehicle' => $vehicle,
            'brands' => $brands,
            'carCategories' => $carCategories,
            'fuelTypes' => $fuelTypes,
            'vehicleCondition' => $vehicleCondition,
            ])
        @endcomponent
    </div>
@endsection

@extends('components.master.main')
@vite([
    'resources/css/Geral/create.css'
    ])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Vehicles.create-vehicles', [
            'brands' => $brands,
            'carCategories' => $carCategories,
            'fuelTypes' => $fuelTypes,
            'vehicleCondition' => $vehicleCondition,
            ])
        @endcomponent
    </div>

@endsection

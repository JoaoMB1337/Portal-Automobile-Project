@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.vehicles.list-vehicles', ['vehicles' => $vehicles, 'fuelTypes' => $fuelTypes])
        @endcomponent
    </div>
@endsection

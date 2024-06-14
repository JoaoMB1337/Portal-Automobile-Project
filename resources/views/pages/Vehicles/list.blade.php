@extends('components.master.main')

@vite(['resources/css/Employees/employee-list.css', 'resources/css/Modals/Modal.css'])

@section('content')
    <div class="mx-auto lg:pl-64">
        @component('components.Vehicles.list-vehicles', ['vehicles' => $vehicles, 'fuelTypes' => $fuelTypes])
        @endcomponent
    </div>
@endsection

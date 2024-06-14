@extends('components.master.main')
@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class=" mx-auto lg:pl-64">

        @component('components.Vehicles.show-vehicles', ['vehicle' => $vehicle])
        @endcomponent

    </div>
@endsection

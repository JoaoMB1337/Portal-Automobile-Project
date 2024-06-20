@extends('components.Master.main')
@vite(['resources/css/Trips/trip-create.css'])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Trip-details.create-trip-detail', [
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees,
            'tripId' => $tripId,
        ])
        @endcomponent
    </div>
@endsection

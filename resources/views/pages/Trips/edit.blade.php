@extends('components.master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Trips.edit-trips',  [
            'trip' => $trip,
            'employees' => $employees,
            'projects' => $projects,
            'typeTrips' => $typeTrips,
            'vehicles' => $vehicles
        ])
        @endcomponent
    </div>
@endsection

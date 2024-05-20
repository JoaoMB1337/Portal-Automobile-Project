@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.trips.create-trips', ['employees' => $employees, 'projects' => $projects,'typeTrips' => $typeTrips])
        @endcomponent
    </div>
@endsection

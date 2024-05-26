@extends('components.master.main')

@section('content')

    <div class=" mx-auto pl-10 lg:pl-64">

    @component('components.Trips.show-trips', ['trip' => $trip,
        'employees' => $employees,
        'vehicles' => $vehicles,
        'tripDetails' => $tripDetails,
        'costTypes' => $costTypes,
        'projects' => $projects])
    @endcomponent

    </div>

@endsection

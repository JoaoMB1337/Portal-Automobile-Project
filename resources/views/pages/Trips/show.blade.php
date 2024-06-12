@extends('components.master.main')
@vite('resources/css/styles.css')

@section('content')
    <div class="lg:pl-64">
    @component('components.Trips.show-trips', [
        'trip' => $trip,
        'employees' => $employees,
        'vehicles' => $vehicles,
        'tripDetails' => $tripDetails,
        'costTypes' => $costTypes,
        'projects' => $projects,
        'totalCost' => $totalCost,
        ])
    @endcomponent

    </div>

@endsection

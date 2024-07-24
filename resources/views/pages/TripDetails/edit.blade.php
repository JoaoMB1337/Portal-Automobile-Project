@extends('components.Master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Trip-details.edit-trip-detail', [
            'tripDetail' => $tripDetail,
            'projects' => $projects,
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees,
        ])
        @endcomponent
    </div>
@endsection

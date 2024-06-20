@extends('components.Master.main')

@vite([
    'resources/css/Modals/Modal.css'
 ])

@section('content')
    <div class="mx-auto lg:pl-64">
        @component('components.Trip-details.list-trip-details', [
            'tripDetails' => $tripDetails,
            'projects' => $projects,
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees
        ])
        @endcomponent
    </div>
@endsection

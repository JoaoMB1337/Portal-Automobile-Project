@extends('components.Master.main')
@vite(['resources/css/Trips/trip-create.css',
     'resources/css/Geral/styles.css',
])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Trips.create-trips', [
            'employees' => $employees,
            'projects' => $projects,
            'typeTrips' => $typeTrips,
            'vehicles' => $vehicles,
            'project_id' => $project_id,
        ])
        @endcomponent

    </div>
@endsection

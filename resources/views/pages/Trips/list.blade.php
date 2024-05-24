@extends('components.master.main')

@section('content')

    <div class=" mx-auto pl-10 lg:pl-64">
           @component('components.Trips.list-trips', [
            'trips' => $trips, 
            'employees' => $employees,
            'project' => $project
            ])
           @endcomponent
    </div>

@endsection


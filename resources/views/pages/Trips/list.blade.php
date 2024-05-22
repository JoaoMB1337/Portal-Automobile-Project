@extends('components.master.main')

@section('content')

    <div class=" mx-auto pl-10 lg:pl-64">
           @component('components.trips.list-trips', ['trips' => $trips, 'project' => $project, 'vehicle'])
           @endcomponent
    </div>

@endsection


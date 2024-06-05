@extends('components.master.main')
@vite('resources/css/styles.css')

@section('content')
    <div class=" mx-auto lg:pl-64">

        @component('components.Projects.show-projects', [
            'project' => $project,
            'trips' => $trips,
            'totalProjectCost' => $totalProjectCost,
        ])
        @endcomponent

    </div>
@endsection

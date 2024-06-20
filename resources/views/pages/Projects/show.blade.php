@extends('components.Master.main')

@vite([
    'resources/css/Geral/styles.css' ,
    'resources/css/Modals/Modal.css'
])

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

@extends('components.master.main')
@vite('resources/css/Projects/project-edit.css')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.Projects.edit-projects', [
            'project' => $project,
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses,
        ])
        @endcomponent
    </div>
@endsection

@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="mx-auto p-8 lg:pl-64">
        @include('components.ProjectReports.form', ['projects' => $projects])
        @isset($trips)
            @include('components.ProjectReports.results', 
            [
                'trips' => $trips, 
                'projectId' => $projectId
            ])
        @endisset
    </div>
@endsection
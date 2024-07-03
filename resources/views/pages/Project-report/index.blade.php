@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="mx-auto p-8 lg:pl-64">
        @include('pages.Project-report.form', ['projects' => $projects])
        @isset($trips)
            @include('pages.Project-report.results', ['trips' => $trips, 'projectId' => $projectId])
        @endisset
    </div>
@endsection

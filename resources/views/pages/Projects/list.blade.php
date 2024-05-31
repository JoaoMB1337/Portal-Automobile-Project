@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css')
@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.Projects.list-projects', [
            'projects' => $projects,
            'countries' => $countries,
            'districts' => $districts,
        ])
        @endcomponent
    </div>
@endsection

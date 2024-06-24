@extends('components.Master.main')

@vite([
    'resources/css/Geral/styles.css',
    'resources/css/Modals/Modal.css'
 ])

@section('content')
    <div class="mx-auto lg:pl-64">
        @component('components.Projects.list-projects', [
            'projects' => $projects,
            'countries' => $countries,
            'districts' => $districts,
        ])
        @endcomponent
    </div>
@endsection

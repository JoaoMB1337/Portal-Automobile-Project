@extends('components.master.main')
@vite([
    'resources/css/Geral/create.css'
    ])
@section('content')
    <div class="lg:pl-64">
        @component('components.Projects.create-projects', [
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses,
        ])
        @endcomponent
    </div>
@endsection

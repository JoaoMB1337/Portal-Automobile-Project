@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.Projects.create-projects', [
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses,
        ])
        @endcomponent
    </div>
@endsection

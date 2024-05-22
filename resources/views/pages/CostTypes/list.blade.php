@extends('components.master.main')

@section('content')
    <div class="mx-auto pl-10 lg:pl-64">
        @component('components.CostTypes.list-costTypes', [
            'costTypes' => $costTypes,
            'projects' => $projects,
            'employees' => $employees,
            'tripDetails' => $tripDetails
        ])
        @endcomponent
    </div>
@endsection

@extends('components.Master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Trip-details.edit-trip-detail', [
            'cost' => $cost,
            'projects' => $projects,
            'costtypes' => $costtypes,
            'currencies' => $currencies,
        ])
        @endcomponent
    </div>
@endsection

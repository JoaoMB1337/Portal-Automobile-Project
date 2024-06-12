@extends('components.master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.trip-details.edit-trip-detail', [
            'cost' => $cost,
            'projects' => $projects,
            'costtypes' => $costtypes,
            'currencies' => $currencies,
        ])
        @endcomponent
    </div>
@endsection

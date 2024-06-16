@extends('components.master.main')
@vite('resources/css/Geral/styles.css')

@section('content')
    <div class="mx-auto lg:pl-64">
        @component('components.trip-details.show-trip-detail', [
            'tripDetail' => $tripDetail,
            'trip' => $trip,
            'project' => $project,
        ])
        @endcomponent
    </div>
@endsection





@extends('components.Master.main')
@vite('resources/css/Geral/styles.css')

@section('content')
    <div class="mx-auto lg:pl-64">
        @component('components.Trip-details.show-trip-detail', [
            'tripDetail' => $tripDetail,
            'trip' => $trip,
            'project' => $project,
        ])
        @endcomponent
    </div>
@endsection





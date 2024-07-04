@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class=" mx-auto p-8 lg:pl-64">
        @include('pages.ExternalCarReport.form')
        @isset($vehicles)
            @include('pages.ExternalCarReport.results', ['vehicles' => $vehicles, 'startDate' => $startDate, 'endDate' => $endDate, 'totalVehicles' => $totalVehicles, 'totalCost' => $totalCost])
        @endisset
    </div>
@endsection

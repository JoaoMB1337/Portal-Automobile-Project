@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="mx-auto p-8 lg:pl-64">
        @include('components.TripCostReport.form')
        @isset($costs)
            @include('components.TripCostReport.results', 
            [
                'costs' => $costs, 
                'startDate' => $startDate, 
                'endDate' => $endDate
            ])
        @endisset
    </div>
@endsection

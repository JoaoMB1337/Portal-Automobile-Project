@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="container mx-auto p-8">
        @include('pages.Cost-report.form')
        @isset($costs)
            @include('pages.Cost-report.results', ['costs' => $costs, 'startDate' => $startDate, 'endDate' => $endDate])
        @endisset
    </div>
@endsection

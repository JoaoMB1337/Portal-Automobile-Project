@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="container mx-auto p-8">
        @include('pages.Insurance-report.form')
        @isset($insurances)
            @include('pages.Insurance-report.results', ['insurances' => $insurances, 'startDate' => $startDate, 'endDate' => $endDate])
        @endisset
    </div>
@endsection

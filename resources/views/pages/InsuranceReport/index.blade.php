@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="container mx-auto p-8 lg:pl-64">
        @include('components.InsuranceReports.form')
        
        @isset($insurances)
            @include('components.InsuranceReports.results', 
            [
                'insurances' => $insurances, 
                'startDate' => $startDate, 
                'endDate' => $endDate, 
                'totalCost' => $totalCost, 
                'totalResults' => $totalResults
            ])
        @endisset
    </div>
@endsection

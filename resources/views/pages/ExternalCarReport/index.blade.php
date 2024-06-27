@extends('components.Master.main')

@vite([
      'resources/css/Reports/reports.css',

 ])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.ExternalCarReport.external-cost-report',  ['vehicles' => $vehicles])
        @endcomponent
    </div>
@endsection

@extends('components.Master.main')

@vite([
      'resources/css/Employees/employee-list.css',
      'resources/css/Modals/Modal.css',
 ])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Cost-reports.cost-report',  ['costs' => $costs])
        @endcomponent
    </div>
@endsection

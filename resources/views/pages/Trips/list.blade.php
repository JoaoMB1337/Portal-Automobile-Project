@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css'])
@vite('resources/css/Modals/modal.css')

@section('content')
  <div class=" mx-auto pl-10 lg:pl-64">
     @component('components.Trips.list-trips', [
      'trips' => $trips,
      'employees' => $employees,
      'project' => $project,
        'vehicles' => $vehicles,
      ])
        @endcomponent
    </div>
@endsection

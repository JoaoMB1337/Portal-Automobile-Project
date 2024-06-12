@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css','resources/css/Modals/Modal.css'])

@section('content')
  <div class=" mx-auto lg:pl-64">
     @component('components.Trips.list-trips', [
      'trips' => $trips,
      'employees' => $employees,
      'project' => $project,
      'vehicles' => $vehicles,
      ])
        @endcomponent
    </div>
@endsection

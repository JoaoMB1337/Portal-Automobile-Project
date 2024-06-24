@extends('components.Master.main')
@vite([
     'resources/css/Geral/styles.css',
     'resources/css/Modals/Modal.css'
     ])

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

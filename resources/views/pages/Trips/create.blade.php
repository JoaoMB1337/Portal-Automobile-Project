@extends('components.master.main')

@section('content')
    <div class="w-full lg:w-3/4 mx-auto pl-10 lg:pl-64">
        @component('components.trips.create-trips', ['employees' => $employees, 'projects' => $projects])
        @endcomponent
    </div>
@endsection
@extends('components.master.main')

@section('content')
        <div class="w-full lg:w-3/4 mx-auto pl-10 lg:pl-64">
               @component('components.trips.list-trips', ['trips' => $trips])
               @endcomponent
        </div>

@endsection
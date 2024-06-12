@extends('components.master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">

        @component('components.Vehicles.show-vehicles', ['vehicle' => $vehicle])
        @endcomponent

    </div>
@endsection

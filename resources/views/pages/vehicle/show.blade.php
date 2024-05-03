@extends('layouts.app')


@section('content')

    @component('components.vehicle.vehicle-show', ['vehicle' => $vehicle])
    @endcomponent

@endsection

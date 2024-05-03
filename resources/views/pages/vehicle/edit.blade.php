@extends('layouts.app')


@section('content')

    @component('components.vehicle.vehicle-edit', ['vehicle' => $vehicle])
    @endcomponent

@endsection


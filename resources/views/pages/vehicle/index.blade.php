@extends('layouts.app')

@section('content')

    @component('components.vehicle.vehicle-index', ['vehicles' => $vehicles])
    @endcomponent

@endsection

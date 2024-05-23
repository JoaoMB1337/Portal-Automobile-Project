@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
               @component('components.insurance.list-insurance', ['insurances' => $insurance])
               @endcomponent
        </div>

@endsection


@extends('components.Master.main')
@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Insurance.show-insurance', ['insurance' => $insurance])
        @endcomponent

    </div>
@endsection

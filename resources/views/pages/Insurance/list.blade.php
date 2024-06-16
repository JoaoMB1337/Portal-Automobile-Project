@extends('components.master.main')
@vite(['resources/css/Geral/styles.css'])
@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class=" mx-auto lg:pl-64">
               @component('components.Insurance.list-insurance', ['insurances' => $insurance])
               @endcomponent
        </div>

@endsection


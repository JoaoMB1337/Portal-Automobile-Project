@extends('components.Master.main')

@vite(['resources/css/Modals/Modal.css',
        'resources/css/Geral/styles.css'])

@section('content')

    <div class=" mx-auto lg:pl-64">

    @component('components.Employees.show-employees', ['employee' => $employee , 'contactTypes' => $contactTypes])
    @endcomponent

    </div>

@endsection




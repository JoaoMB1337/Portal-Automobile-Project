@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css'])

@section('content')
    <div class="w-full lg:w-3/4 mx-auto pl-10 lg:pl-64">
        @component('components.Insurance.create-insurance')
        @endcomponent
    </div>
@endsection

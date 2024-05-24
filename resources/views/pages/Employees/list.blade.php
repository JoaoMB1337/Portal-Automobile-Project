@extends('components.master.main')

@section('content')
        <div class=" mx-auto pl-10 lg:pl-64">
               @component('components.employees.list-employees',  ['employees' => $employees, 'roles' => $roles])
               @endcomponent
        </div>

@endsection


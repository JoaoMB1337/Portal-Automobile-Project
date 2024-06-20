@extends('components.Master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Employees.edit-employees', [
            'employee' => $employee,
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes,
            'isAdmin' => $isAdmin
        ])
        @endcomponent
    </div>
@endsection

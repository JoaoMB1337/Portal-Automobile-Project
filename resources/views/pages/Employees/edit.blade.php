@extends('components.master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Employees.edit-employees', [
            'employee' => $employee,
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes,
        ])
        @endcomponent
    </div>
@endsection

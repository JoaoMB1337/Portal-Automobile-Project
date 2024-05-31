@extends('components.master.main')
@vite(['resources/css/Employees/employee-create.css'])

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.Employees.create-employees', [
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes
            ])
        @endcomponent
    </div>
@endsection

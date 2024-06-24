@extends('components.Master.main')
@vite([
    'resources/css/Geral/create.css'
    ])

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Employees.create-employees', [
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes,
            'isAdmin' => $isAdmin
            ])
        @endcomponent
    </div>
@endsection

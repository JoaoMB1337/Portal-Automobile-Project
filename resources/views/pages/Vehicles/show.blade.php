@extends('components.Master.main')
@vite([
        'resources/css/Modals/Modal.css',
        'resources/css/Geral/styles.css'
      ])

@section('content')
    <div class="  lg:pl-64">

        @component('components.Vehicles.show-vehicles',
        [
            'vehicle' => $vehicle,
            'insurances' => $insurances,
        ])
        @endcomponent

    </div>
@endsection

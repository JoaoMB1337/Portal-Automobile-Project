@extends('components.Master.main')
@vite([
    'resources/css/Modals/Modal.css'
    ])

@section('content')
    <div class="  lg:pl-64">

        @component('components.Vehicles.show-vehicles', ['vehicle' => $vehicle])
        @endcomponent

    </div>
@endsection

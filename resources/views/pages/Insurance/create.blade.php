@extends('components.Master.main')
@vite([
       'resources/css/Geral/create.css'
    ])

@section('content')
    <div class="w-full lg:w-3/4 mx-auto lg:pl-64">
        @component('components.Insurance.create-insurance', ['vehicles' => $vehicles])
        @endcomponent
    </div>
@endsection

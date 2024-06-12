@extends('layouts.app')
@extends('components.master.main')

@section('content')
    <div class=" mx-auto lg:pl-64">
        @component('components.Insurance.edit-insurance', ['insurance' => $insurance])
        @endcomponent
    </div>
@endsection

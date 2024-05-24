@extends('components.master.main')

@section('content')
    <div class="w-full lg:w-3/4 mx-auto pl-10 lg:pl-64">
        @component('components.insurance.edit-insurance', ['insurance' => $insurance])
        @endcomponent
    </div>
@endsection

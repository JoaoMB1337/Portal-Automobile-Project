@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.cost.edit-cost', [
            'cost' => $cost,
            'projects' => $projects,
            'costtypes' => $costtypes,
            'currencies' => $currencies,
        ])
        @endcomponent
    </div>
@endsection

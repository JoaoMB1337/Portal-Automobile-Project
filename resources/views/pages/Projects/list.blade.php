@extends('components.master.main')

@section('content')

    <div class="w-full lg:w-3/4 mx-auto pl-5 lg:pl-60">
        @component('components.projects.list-projects', ['projects' => $projects])
        @endcomponent
    </div>

@endsection

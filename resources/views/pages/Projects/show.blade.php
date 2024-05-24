@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">

        @component('components.Projects.show-projects', ['project' => $project])
        @endcomponent

    </div>
@endsection

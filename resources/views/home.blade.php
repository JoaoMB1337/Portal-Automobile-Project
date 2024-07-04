@extends('components.Master.main')
@vite(['resources/js/Home/home.js'])

@section('content')
    @if (Auth::check())
        <body class="bg-gray-100 h-screen">
            <div class="mx-auto lg:pl-64">
                <div class="overflow-x-auto">
                    <div class="container mx-auto p-4">
                        @if (Auth::user()->isMaster())
                            <div class="mt-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 justify-center">
                                    <!-- Employees -->
                                    @include('components.HomeComponents.user-panel')
                                    <!-- Vehicles -->
                                    @include('components.HomeComponents.vehicles-use')
                                </div>
                                @include('components.HomeComponents.table-component')
                            </div>
                        @elseif (Auth::user()->isFuncionario())
                            <!-- Pagina Employee -->
                            @include('home-employee')
                            <!-- modal -->
                            @include('modal-viagens-employee')
                        @endif
                    </div>
                </div>
            </div>
        </body>
    @endif
@endsection

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
                                <div class="grid md:grid-cols-2 gap-6 mb-6 justify-center">
                                    <div class="bg-white rounded-lg border border-yellow-300 p-4 shadow-sm" id="datetimeContainer">
                                    </div>
                                        <button id="create-project" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Criar Projeto</button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 justify-center">
                                    <!-- Employees -->
                                    @include('components.HomeComponents.user-panel')
                                    <!-- Vehicles -->
                                    @include('components.HomeComponents.vehicles-use')
                                    <!-- Warning -->
                                    @include('components.HomeComponents.warning-panel')
                                </div>
                                @include('components.HomeComponents.table-component')
                                @include('components.Modals.modal-projects')
                                @include('components.Modals.modal-trips')
                                @include('components.Modals.modal-vehicles')
                            </div>
                        @elseif (Auth::user()->isFuncionario())
                            <!-- Pagina Employee -->
                            @include('home-employee')
                            <!-- modal -->
                            @include('components.Modals.modal-viagens-employee')
                        @endif
                    </div>
                </div>
            </div>
        </body>
    @endif
@endsection

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
                            <!-- Barra de tempo e botão -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 justify-center">
                                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                                    <div class="text-center py-2 mb-4 rounded" id="time-bar">
                                        <!-- Barra de tempo -->
                                    </div>
                                </div>
                                <button id="programarViagensBtn" class="bg-blue-500 text-white px-4 py-2 rounded self-center">
                                    Programar Viagens
                                </button>
                            </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 justify-center">
                                    <!-- Employees -->
                                    @include('components.HomeComponents.user-panel')
                                    <!-- Vehicles -->
                                    @include('components.HomeComponents.vehicles-use')
                                </div>
                                @include('components.HomeComponents.table-component')
                                <!-- modal Program-->
                                @include('components.Modals.modal-trips')
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

    @include('components.Modals.modal-trips', [
        'projectstatuses' => $projectstatuses,
        'countries' => $countries,

    ])
@endsection

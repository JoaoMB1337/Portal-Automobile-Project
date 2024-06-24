@extends('components.Master.main')
@vite(['resources/js/Home/home.js'])

@section('content')
    @if(Auth::check() && Auth::user()->isMaster())
        <body class="bg-gray-100 h-screen">
        <div class="mx-auto lg:pl-64">
            <div class="overflow-x-auto">
                <div class="container mx-auto p-4">
                    <div class="mt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 justify-center">
                            <!-- Employees in Use -->
                            @include('components.HomeComponents.user-panel')
                            <!-- Vehicles in Use -->
                            @include('components.HomeComponents.vehicles-use')
                        </div>
                        @include('components.HomeComponents.table-component')
                    </div>
                </div>
            </div>
        </div>
        </body>
    @else
        <div class="mx-auto lg:pl-64">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-6">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="font-semibold">
                                        <p class="text-gray-800 font-bold">{{ Auth::user()->name }}</p>
                                        <p class="text-gray-600">{{ Auth::user()->employee_number }}</p>
                                        <p class="text-gray-600">{{ Auth::user()->role->name }}</p>
                                        <br>
                                        <a href="{{ route('employees.show', Auth::user()->id) }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">Show profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Viagens Atribuídas Hoje -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm mt-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Viagens Atribuídas Hoje</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Início</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Término</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destino</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adicionar Custo</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($activeTrips as $trip)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $trip->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $trip->end_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $trip->destination }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <a href="{{ route('trip-details.create', ['trip_id' => $trip->id]) }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">Adicionar Custo</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">Nenhuma viagem atribuída hoje.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

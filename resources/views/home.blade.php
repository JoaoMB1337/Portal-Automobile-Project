@extends('components.master.main')
@section('content')

    @if(Auth::check() && Auth::user()->employee_role_id == 2)

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <body class="bg-gray-100 h-screen">
        <div class="overflow-x-auto">
            <div class="container mx-auto p-4">
                <div class="mt-6">
                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <!-- Perfil do usuário -->
                        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                            <div class="flex flex-col justify-between mb-4">
                                <div>
                                    <div class="flex items-center mb-4">
                                        <div class="font-semibold">
                                            <p class="text-gray-900 text-lg font-bold">{{ Auth::user()->name }}</p>
                                            <p class="text-gray-700">{{ Auth::user()->employee_number }}</p>
                                            <p class="text-gray-700">{{ Auth::user()->role->name }}</p>
                                            <br>
                                            <a href="{{ route('employees.show', Auth::user()->id) }}" class="text-[#f84525] font-medium text-sm hover:text-red-700">Show profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Seção Veículos em Uso -->
                        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                            <h2 class="text-xl font-semibold mb-4 text-gray-900">Veiculos Em Uso</h2>
                            <h2 class="text-center text-3xl font-bold text-gray-900">{{ $vehicleactive }}</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Seção Veículos -->
                        <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-center">
                            <div class="w-full">
                                <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Veículos</h2>
                                <canvas id="vehiclesChart" class="w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Seção Projetos -->
                        <div class="bg-white p-4 rounded-lg shadow-sm md:col-span-2">
                            <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Projetos</h2>
                            <canvas id="projectsChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <!-- Seção Seguros a Terminar -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm mt-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Seguros a Terminar</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Matricula
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Companhia
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Número da Apólice
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data de Expiração
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($endingInsurances as $insurance)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->vehicle->plate }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->insurance_company }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->policy_number }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $insurance->end_date }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                                            Nenhum seguro a terminar.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Dados dos veículos
                        var vehiclesData = {
                            internal: @json($internalVehiclesCount),
                            external: @json($externalVehiclesCount)
                        };

                        var ctxVehicles = document.getElementById('vehiclesChart').getContext('2d');
                        new Chart(ctxVehicles, {
                            type: 'pie',
                            data: {
                                labels: ['Internos', 'Externos'],
                                datasets: [{
                                    data: [vehiclesData.internal, vehiclesData.external],
                                    backgroundColor: ['#37afa5', '#1b3342']
                                }]
                            }
                        });

                        // Dados dos projetos
                        var projectsData = {
                            notStarted: @json($projectsNotStarted),
                            inProgress: @json($projectsInProgress),
                            completed: @json($projectsCompleted),
                            cancelled: @json($projectsCancelled),
                            onHold: @json($projectsOnHold)
                        };

                        var ctxProjects = document.getElementById('projectsChart').getContext('2d');
                        new Chart(ctxProjects, {
                            type: 'bar',
                            data: {
                                labels: ['Não Iniciado', 'Em Progresso', 'Concluído', 'Cancelado', 'Em Espera'],
                                datasets: [{
                                    label: 'Projetos',
                                    data: [
                                        projectsData.notStarted,
                                        projectsData.inProgress,
                                        projectsData.completed,
                                        projectsData.cancelled,
                                        projectsData.onHold
                                    ],
                                    backgroundColor: [
                                        '#1b3342',
                                        '#36A2EB',
                                        '#37afa5',
                                        '#c1c3c6',
                                        '#f83038'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });

                    });
                </script>
            </div>

            @else
                <div class="mx-auto pl-10 lg:pl-64">
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
                    </div>
                </div>
    @endif

@endsection

@extends('components.master.main')
@section('content')

@if(Auth::check() && Auth::user()->employee_role_id == 2)

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body class="bg-gray-100 h-screen">
<div class="lg:pl-64 overflow-x-auto">
    <div class="container mx-auto p-4">
        <div class="mt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Perfil do usuário -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
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
                <!-- Seção Viagens -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Viagens </h2>
                    <h2 class="text-center text-4xl font-bold text-gray-900">{{ $totalTrips }}</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Seção Veículos -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Veículos</h2>
                    <canvas id="vehiclesChart" class="w-full h-full"></canvas>
                </div>

                <!-- Seção Projetos -->
                <div class="bg-white p-6 rounded-lg shadow-sm col-span-2">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Projetos</h2>
                    <canvas id="projectsChart" class="w-full h-full"></canvas>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
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

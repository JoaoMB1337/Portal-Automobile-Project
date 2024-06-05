@extends('components.master.main')

@if(Auth::check() && Auth::user()->employee_role_id == 2)

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 h-screen">
<div class="lg:pl-64 overflow-x-auto">
    <div class="container mx-auto p-4">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <!-- Perfil do usuário -->
                <div class="bg-white rounded-md border border-gray-100 p-4 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
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
                <!-- Seção Viagens -->
                <div class="bg-white rounded-md border border-gray-100 p-4 shadow-md shadow-black/5">
                    <h2 class="text-xl font-semibold mb-4">Viagens</h2>
                    <h2 class="text-center text-2xl">{{ $totalTrips }}</h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Seção Veículos -->
            <!-- Seção Veículos -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Veículos</h2>
                <canvas id="vehiclesChart" style="width: 200px; height: 200px;"></canvas>
            </div>



            <!-- Seção Projetos -->
            <div class="bg-white p-2 rounded-md shadow-md">
                <h2 class="text-lg font-semibold mb-2">Projetos</h2>
                <canvas id="projectsChart"></canvas>
            </div>
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
                    backgroundColor: ['#4CAF50', '#FF5733']
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
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#E7E9ED',
                        '#4BC0C0'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
</body>
</html>

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

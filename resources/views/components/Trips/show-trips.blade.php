@vite(['resources/css/Trips/trip-show.css'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Viagem</title>
</head>

<body>
    <!-- Modal de Imagem -->
    <div id="imageModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 class="text-2xl  mb-3">Comprovativo</h2>
            <img id="modalImage" src="" alt="Comprovante de gasto" class="modal-img w-full h-auto"
                style="max-height: 75vh; object-fit: contain;">
        </div>
    </div>
    <!-- Conteúdo Principal -->
    <div class="container py-8 px-4 sm:px-6 lg:px-8">
        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                @include('components.ButtonComponents.backButton')

                <div class="text-center flex-grow mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes da viagem</h3>
                </div>
            </div>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes da viagem</p>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de início</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->start_date }}</dd>
                    </div>
                    <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de fim</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->end_date }}</dd>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Destino</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->destination }}</dd>
                    </div>
                    <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Propósito</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->purpose }}</dd>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Projeto</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->project->name }}</dd>
                    </div>
                    <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Funcionários</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @foreach ($employees as $employee)
                                {{ $employee->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Veículos</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @foreach ($vehicles as $vehicle)
                                {{ $vehicle->plate }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </dd>
                    </div>
                    <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Total de custos</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ number_format($totalCost, 2, ',', '.') }}
                        </dd>
                    </div>
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <div class="mt-10 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('trips.edit', ['trip' => $trip->id]) }}"
                                class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-center w-full sm:w-auto">
                                Editar 
                            </a>
                            <button id="openModalBtn"
                                class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full sm:w-auto text-center">
                                Eliminar 
                            </button>
                        </div>
                    @endif
                </dl>
            </div>
        </div> @include('components.Modals.modal-delete-single') <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
            <div class="px-6 py-4">
                <h3 class="text-2xl font-semibold text-gray-900">Detalhes da viagem</h3>
                <p class="mt-1 text-gray-600">Informações detalhadas sobre os custos da viagem</p>
                @if (Auth::check())
                    <div class="flex flex-col justify-between items-start mt-4">
                        @if ($trip->project->project_status_id != 3)
                            <a href="{{ route('trip-details.create', ['trip_id' => $trip->id]) }}"
                                class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg> Adicionar detalhe </a>
                        @else
                            <button id="addDetailBtn"
                                class="flex items-start px-4 py-2 bg-green-700 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 cursor-not-allowed">
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg> Adicionar detalhe </button>
                            <p id="errorMessage" class="text-red-500 text-sm mt-2 hidden">O status do projeto está
                                concluído, não é possível adicionar custos.</p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="border-t border-gray-200 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo de custo</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Custo</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comprovante</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tripDetails as $tripDetail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <a
                                        href="{{ url('trip-details/' . $tripDetail->id) }}">{{ $tripDetail->costType->type_name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($tripDetail->cost, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($tripDetail->file)
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 viewImageBtn"
                                            data-image-url="{{ asset('storage/projects/' . $trip->project->id . '/trips/' . $tripDetail->trip_id . '/receipts/' . $tripDetail->file) }}">
                                            <i class="fas fa-file"></i> Ver </a>
                                    @else
                                        Nenhum comprovativo disponível.
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .cursor-not-allowed {
            cursor: not-allowed;
        }

        .text-sm {
            font-size: 0.875rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('imageModal');
            var modalImage = document.getElementById('modalImage');
            var closeModal = document.querySelector('.close-modal');

            document.querySelectorAll('.viewImageBtn').forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    var imageUrl = btn.getAttribute('data-image-url');
                    if (imageUrl) {
                        modalImage.src = imageUrl;
                        document.body.classList.add('modal-open');
                    } else {
                        console.error('URL da imagem não encontrada.');
                    }
                });
            });

            closeModal.addEventListener('click', function() {
                document.body.classList.remove('modal-open');
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    document.body.classList.remove('modal-open');
                }
            });
        });
    </script>
</body>

</html>

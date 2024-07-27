@vite(['resources/css/Trips/trip-show.css'])
<div class="container py-8 px-4">
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
    <div class="w-full">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
            @include('components.ButtonComponents.backButton')
                <div class="flex-grow text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes do veículo</h3>
                </div>
                <div class="w-10 h-10"></div>

            </div>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes principais</p>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->plate }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Marca</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->brand->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Numero de passageiros</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->passenger_quantity }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Categoria</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->carCategory->category }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipo de combustível</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->fuelType->type }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">É externo?</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if ($vehicle->is_external)
                                Sim
                            @else
                                Não
                            @endif
                        </dd>
                    </div>

                    @if (!$vehicle->is_external)
                        <div class="flex flex-col sm:flex-row justify-center py-4 gap-2 pt-10">
                            <a href="{{ route('vehicles.edit', ['vehicle' => $vehicle->id]) }}"
                                class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-center w-full sm:w-auto">
                                Editar
                            </a>
                            <button id="openModalBtn"
                                class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full sm:w-auto text-center">
                                Eliminar
                            </button>
                        </div>
                    @endif

                    @include('components.Modals.modal-delete-single')

                    @if ($vehicle->is_external)
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Contrato</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->contract_number }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Data de início do aluguer</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_start_date }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Data de fim do aluguer</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_end_date }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Valor do aluguer por dia</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_price_per_day }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Empresa de rentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_company }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Pessoa responsável da rentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_contact_person }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Contacto da rentCar</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $vehicle->rental_contact_number }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">PDF</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                <a href="{{ route('vehicles.downloadPdf', ['vehicle' => $vehicle->id]) }}"
                                    class="inline-block ">
                                    Download PDF
                                </a>

                                <!-- Exibir a mensagem de erro, se houver -->
                                @if (session('error'))
                                    <div class="alert alert-danger mt-4">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </dd>

                        </div>

                        <div class="flex flex-col sm:flex-row justify-center py-4 gap-2 pt-10">
                            <a href="{{ route('vehicles.edit', ['vehicle' => $vehicle->id]) }}"
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

            <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
                <div class="px-6 py-4">
                    <h3 class="text-2xl font-semibold text-gray-900">Seguros</h3>
                    <p class="mt-1 text-gray-600">Lista de seguros associados ao veículo</p>
                    @if (Auth::check() && Auth::user()->isMaster())
                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('insurances.create', ['vehicle_id' => $vehicle->id]) }}"
                                class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
                                <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Adicionar seguro
                            </a>
                        </div>
                    @endif
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Companhia
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Número da apólice
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Custo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data fim
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($insurances as $insurance)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <a href="{{ route('insurances.show', ['insurance' => $insurance->id]) }}">
                                        {{ $insurance->insurance_company }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $insurance->policy_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ number_format($insurance->cost, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $insurance->end_date }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                                    Nenhum seguro encontrado.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $insurances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.Modals.modal-delete-single')
<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    @media (max-width: 640px) {
        .flex-col {
            flex-direction: column;
        }

        .w-full {
            width: 100%;
        }

        .mt-10 {
            margin-top: 2.5rem;
        }

        .sm\:col-span-2 {
            grid-column: span 2 / span 2;
        }
    }
</style>

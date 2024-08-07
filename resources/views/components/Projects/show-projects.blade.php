@vite(['resources/css/Trips/trip-show.css'])
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
            <div class="flex-grow text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes do projeto</h3>
            </div>
        </div>

        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes do projeto</p>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nome</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->name }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Endereço</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->address }}</dd>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Status do projeto</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $project->projectstatus->status_name }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Distrito</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ optional($project->district)->name ?? 'Sem Distrito' }}</dd>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">País</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $project->country->name }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Total do projeto</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ number_format($totalProjectCost, 2, ',', '.') }}
                    </dd>
                </div>
                @if (Auth::check() && Auth::user()->isAdmin())
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('projects.edit', ['project' => $project->id]) }}"
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
    </div>
    @include('components.Modals.modal-delete-single')

    <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
        <div class="px-6 py-4">
            <h3 class="text-2xl font-semibold text-gray-900">Viagem</h3>
            <p class="mt-1 text-gray-600">Lista de viagens associadas ao projeto</p>
            @if (Auth::check() && Auth::user()->isMaster())
                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('trips.create', ['project_id' => $project->id]) }}"
                        class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
                        <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Adicionar viagem
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
                            Destino</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                            de início</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                            de fim</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Custo
                            total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($trips as $trip)
                        <tr style="cursor:pointer;">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                <a href="{{ url('trips/' . $trip->id) }}">{{ $trip->destination }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $trip->start_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $trip->end_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ number_format($trip->tripDetails->sum('cost'), 2, ',', '.') }}</td>
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

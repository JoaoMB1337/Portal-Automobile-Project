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
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes do Seguro</h3>
                </div>
                <div class="w-10 h-10"></div>
            </div>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes principais</p>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Companhia de seguros</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $insurance->insurance_company }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Número da apólice</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $insurance->policy_number }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de início</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $insurance->start_date }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de fim</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $insurance->end_date }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Custo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ number_format($insurance->cost, 2, ',', '.') }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $insurance->vehicle->plate }}</dd>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center py-4 gap-2 pt-10">
                        <a href="{{ route('insurances.edit', ['insurance' => $insurance->id]) }}"
                            class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-center w-full sm:w-auto">
                            Editar
                        </a>
                        <button id="openModalBtn"
                            class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full sm:w-auto text-center">
                            Eliminar
                        </button>
                    </div>
                </dl>
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

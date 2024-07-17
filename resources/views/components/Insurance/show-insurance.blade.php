<div class="flex justify-center items-start h-screen custom-bg">
    <div class="w-full max-w-2xl bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('insurances.index') }}">
                <button type="button"
                    class="flex items-center justify-center w-10 h-10 px-3 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <div class="flex-grow text-center">
                <h1 class="text-2xl font-semibold text-gray-900">Detalhes do seguro</h1>
            </div>
            <div class="w-10 h-10"></div> <!-- Espaço vazio para alinhar o título ao centro -->
        </div>

        <div class="mb-6">
            <div class="font-semibold">Companhia de seguros:</div>
            <div>{{ $insurance->insurance_company }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Número da apólice:</div>
            <div>{{ $insurance->policy_number }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de início:</div>
            <div>{{ $insurance->start_date }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de fim:</div>
            <div>{{ $insurance->end_date }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Custo:</div>
            <div>{{ number_format($insurance->cost, 2, ',', '.') }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Matrícula:</div>
            <div>{{ $insurance->vehicle->plate }}</div>
        </div>

        <div class="px-6 py-4 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('insurances.edit', ['insurance' => $insurance->id]) }}"
                class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-center w-full sm:w-auto">
                Editar
            </a>
            <button id="openModalBtn"
                class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-center w-full sm:w-auto">
                Eliminar
            </button>
        </div>
    </div>
    @include('components.Modals.modal-delete-single')
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

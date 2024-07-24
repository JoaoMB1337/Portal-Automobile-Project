<div class="flex justify-center items-start h-screen custom-bg">
    <div class="w-full max-w-2xl bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex items-center justify-between mb-4">
            @include('components.ButtonComponents.backButton')
            <div class="flex-grow text-center">
                <h1 class="text-2xl font-semibold text-gray-900">Detalhes do seguro</h1>
            </div>
            <div class="w-10 h-10"></div> 
        </div>

        <div class="mb-6">
            <div class="font-semibold">Companhia de seguros:</div>
            <div>{{ $insurance->insurance_company ?? 'N/A' }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Número da apólice:</div>
            <div>{{ $insurance->policy_number ?? 'N/A' }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de início:</div>
            <div>{{ $insurance->start_date ?? 'N/A' }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de fim:</div>
            <div>{{ $insurance->end_date ?? 'N/A' }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Custo:</div>
            <div>{{ number_format($insurance->cost ?? 0, 2, ',', '.') }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Matrícula:</div>
            <div>{{ $insurance->vehicle->plate ?? 'N/A' }}</div>
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

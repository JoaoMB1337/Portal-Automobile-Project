@vite('resources/js/Geral/list.js')
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

<body class="custom-bg">

<div class="container py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <a class="mr-3" id="pageBack">
                    <button type="button" class="flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                        <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </button>
                </a>
                <div class="flex-grow text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes da Viagem</h3>
                </div>
                <div class="w-10 h-10"></div>
            </div>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 text-center">Detalhes Principais</p>
            <div class="border-t border-gray-200 mt-4">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">ID</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->id }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Viagem</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->trip->destination }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipo de Custo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->costType->type_name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Custo Total</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $tripDetail->cost }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Comprovante de Gastos</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($tripDetail->file)
                                <img src="{{ asset('storage/projects/' . $project->id . '/trips/' . $tripDetail->trip_id . '/receipts/' . $tripDetail->file) }}" alt="Comprovante de Gastos" class="max-w-full h-auto">
                            @else
                                Sem comprovante de gastos disponível.
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>

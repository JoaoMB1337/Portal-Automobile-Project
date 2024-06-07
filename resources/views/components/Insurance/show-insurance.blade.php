<div class="flex justify-center items-start h-screen custom-bg">
    <div class="w-full bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('insurances.index') }}">
                <button type="button"
                    class="flex items-center justify-center w-1/2 mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <div class="text-center flex-grow mb-6">
                <h1>Detalhes do Seguro</h1>
            </div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Companhia de
                Seguros:</div>
            <div>{{ $insurance->insurance_company }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Número da Apólice:</div>
            <div>{{ $insurance->policy_number }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de Início:</div>
            <div>{{ $insurance->start_date }}</div>
        </div>

        <div class="mb-6">
            <div class="font-semibold">Data de Fim:</div>
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


    </div>
</div>

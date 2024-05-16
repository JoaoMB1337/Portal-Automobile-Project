<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div>
    <a href="{{ url('trips') }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Voltar para trás">
        <i class="fas fa-arrow-left"></i>
    </a>
<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes da Viagem</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalhes da viagem</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de Início</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->start_date }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de Fim</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->end_date }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Destino</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->destination }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Propósito</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->purpose }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Projeto</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->project->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Funcionário</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $trip->employee->name }}</dd>
                    </div>
                </dl>
                
            </div>
        </div>
    </div>
</div>
</div>

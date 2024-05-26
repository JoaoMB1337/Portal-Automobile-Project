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
                            <dt class="text-sm font-medium text-gray-500">Funcionários</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                @foreach ($employees as $employee)
                                    {{ $employee->name }}@if (!$loop->last), @endif
                                @endforeach
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Veículos</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                @foreach ($vehicles as $vehicle)
                                    {{ $vehicle->plate }}@if (!$loop->last), @endif
                                @endforeach
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Tipo de Custo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                @foreach ($tripDetails as $tripDetail)
                                    {{ $tripDetail->costType->type_name }}@if (!$loop->last), @endif
                                @endforeach
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Custo Total</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                @foreach ($tripDetails as $tripDetail)
                                    {{ number_format($tripDetail->cost, 2, ',', '.') }}@if (!$loop->last), @endif
                                @endforeach
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Comprovante de Gastos</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                @foreach ($tripDetails as $tripDetail)
                                    <a href="{{ asset('storage/' . $tripDetail->receipt) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-file"></i>
                                    </a>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

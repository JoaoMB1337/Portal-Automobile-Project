<div class="container py-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('trips.index') }}" class="mr-3">
                <button type="button" class="flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <div class="text-center flex-grow mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes da Viagem</h3>
            </div>
        </div>



        Detalhes do Projeto
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Data de Início</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $trip->start_date }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Data de Fim</dt>
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
                    <dt class="text-sm font-medium text-gray-500">Total de Custos</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ number_format($totalCost, 2, ',', '.') }}</dd>
                </div>

                <div class=" mt-10">
                    <a href="{{ route('trips.edit', ['trip' => $trip->id]) }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('trips.destroy', ['trip' => $trip->id]) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            Eliminar
                        </button>
                    </form>
                </div>
            </dl>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
        <div class="px-6 py-4">
            <h3 class="text-2xl font-semibold text-gray-900">Detalhes da Viagem</h3>
            <p class="mt-1 text-gray-600">Informações detalhadas sobre os custos da viagem</p> <!-- Movido aqui -->
            <div class="flex justify-between items-center mt-4">
                <!-- Adicionado um div para manter o botão na mesma linha -->
                <a href="{{ route('trip-details.create', ['trip_id' => $trip->id]) }}"
                    class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600  border  rounded-md font-semibold text-xs text-white uppercase tracking-widest  disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Adicionar Detalhe
                </a>
            </div>
        </div>
        <div class="border-t border-gray-200 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 ">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo
                            de Custo</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Custo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Comprovante</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($tripDetails as $tripDetail)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $tripDetail->costType->type_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($tripDetail->cost, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($tripDetail->file)
                                    <a href="{{ asset('storage/projects/' . $trip->project->id . '/trips/' . $tripDetail->trip_id . '/receipts/' . $tripDetail->file) }}"
                                        target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-file"></i> Ver
                                    </a>
                                @else
                                    Sem comprovante de gastos disponível.
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
</style>

<div class="container py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4">
            <a href="{{ route('vehicles.index') }}">
                <button type="button" class="btn-projects flex items-center justify-center w-1/2 mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <h3 class="text-2xl font-semibold text-gray-900">Detalhes do Veículo</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Matrícula</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $vehicle->plate }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Marca</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $vehicle->brand->name }}</dd>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Categoria</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $vehicle->carCategory->category }}</dd>
                </div>
                <div class="bg-white px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Tipo de Combustível</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $vehicle->fuelType->type }}</dd>
                </div>
                <div class="bg-gray-50 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Externo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $vehicle->is_external ? 'Sim' : 'Não' }}</dd>
                </div>
            </dl>
        </div>
        <div class="px-6 py-4">
            <a href="{{ route('vehicles.edit', ['vehicle' => $vehicle->id]) }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                Editar
            </a>
            <form method="POST" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle->id]) }}" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
        <div class="px-6 py-4">
            <h3 class="text-2xl font-semibold text-gray-900">Seguros</h3>
            <p class="mt-1 text-gray-600">Lista de seguros associados ao veículo</p>
            @if(Auth::check() && Auth::user()->isAdmin())
            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('insurances.create', ['vehicle_id' => $vehicle->id]) }}"
                    class="flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Adicionar Seguro
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
                            Companhia</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número da Apólice
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Custo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ativo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($vehicle->insurances as $insurance)
                        <tr data-url="{{ url('insurances/' . $insurance->id) }}" style="cursor:pointer;">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $insurance->insurance_company }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $insurance->policy_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ number_format($insurance->cost, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $insurance->ativo ? 'Sim' : 'Não' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                <a href="{{ route('insurances.edit', $insurance->id) }}"><i class="fas fa-edit"></i></a>
                                <form method="post" action="{{ route('insurances.destroy', $insurance->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
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
        </div>
    </div>
</div>

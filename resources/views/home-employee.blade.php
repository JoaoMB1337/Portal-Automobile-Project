<div class="mt-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
        <div class="col-span-12 bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-col justify-between mb-4">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="font-semibold text-center w-full">
                            <p class="text-gray-900 text-lg font-bold">Bem-vindo</p>
                            <p>{{ Auth::user()->name }}</p>
                            <p class="text-gray-700 mt-2">{{ Auth::user()->employee_number }}</p>
                            <a href="{{ route('employees.show', Auth::user()->id) }}" class="text-[#f84525] font-medium text-sm hover:text-red-700 mt-3">Show profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm mt-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Viagens Atribuídas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Início</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Destino</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Adicionar Custo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($activeTrips as $trip)
                        <tr>
                            <td class="py-4 whitespace-nowrap text-center text-gray-800 cursor-pointer" onclick="showTripDetails('{{ $trip->id }}', '{{ $trip->start_date }}', '{{ $trip->end_date }}', '{{ $trip->destination }}', '{{ $trip->details }}')">
                                {{ $trip->start_date }}
                            </td>
                            <td class="py-4 whitespace-nowrap text-center text-gray-800 cursor-pointer" onclick="showTripDetails('{{ $trip->id }}', '{{ $trip->start_date }}', '{{ $trip->end_date }}', '{{ $trip->destination }}', '{{ $trip->details }}')">
                                {{ $trip->destination }}
                            </td>
                            <td class="py-4 whitespace-nowrap text-center text-gray-800">
                                <a href="{{ route('trip-details.create', ['trip_id' => $trip->id]) }}" class="bg-green-700 hover:bg-green-600 text-white font-medium text-sm px-3 py-2 rounded">Adicionar Custo</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">Nenhuma viagem atribuída hoje.</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>
            <div class="py-5 flex justify-center">
            {{ $activeTrips->links() }}
            </div>
        </div>
    </div>
</div>

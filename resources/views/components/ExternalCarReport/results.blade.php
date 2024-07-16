@if($vehicles->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6">Detalhes dos Carros Externos</h2>

        <!-- Novo bloco para exibir o total dos veículos e custos -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xl font-bold text-gray-700">Total de Veículos:</span>
                    <span class="text-xl font-semibold text-green-600">{{ $totalVehicles }}</span>
                    <br>
                    <span class="text-xl font-bold text-gray-700">Total de Custos:</span>
                    <span class="text-xl font-semibold text-green-600">{{ number_format($totalCost, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Tabela de Resultados -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Preço de Aluguer por Dia</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Empresa de Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Início do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Fim do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Custo Total de Aluguer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $vehicle->plate }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($vehicle->rental_price_per_day, 2, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">{{ $vehicle->rental_company }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($vehicle->rental_start_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($vehicle->rental_end_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($vehicle->total_rental_cost, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $vehicles->appends(request()->input())->links() }}
        </div>

        <!-- Formulário para Download PDF -->
        <div class="mt-6 text-right">
            <form action="{{ route('external.car.report.generate') }}" method="GET" class="inline-block">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">Baixar Relatório PDF</button>
            </form>
        </div>
    </div>
@else
    <div class="mt-8 bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Preço de Aluguer por Dia</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Empresa de Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Início do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Fim do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Custo Total de Aluguer</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado" class="w-64 h-64 mx-auto">
                        <p class="mt-4 text-center">Nenhum veiculo encontrado</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

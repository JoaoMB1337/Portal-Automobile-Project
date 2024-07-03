@if($vehicles->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl  mb-6">Detalhes dos Carros Externos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Matricula</th>
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
                        <td class="py-3 px-4 border-b">{{ $vehicle->rental_price_per_day }}</td>
                        <td class="py-3 px-4 border-b">{{ $vehicle->rental_company }}</td>
                        <td class="py-3 px-4 border-b">{{ $vehicle->rental_start_date }}</td>
                        <td class="py-3 px-4 border-b">{{ $vehicle->rental_end_date }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($vehicle->total_rental_cost, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold text-gray-700">Total de Veículos:</td>
                    <td class="py-3 px-4 border-b font-semibold text-gray-700">{{ $totalVehicles }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold text-gray-700">Total de Custos:</td>
                    <td class="py-3 px-4 border-b font-semibold text-gray-700">{{ number_format($totalCost, 2) }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="mt-6">
            {{ $vehicles->appends(request()->input())->links() }}
        </div>
        <form action="{{ route('external.car.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="w-full  bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Matricula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Preço de Aluguer por Dia</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Empresa de Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Início do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data de Fim do Aluguer</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Custo Total de Aluguer</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="6">Nenhum carro externo encontrado</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif

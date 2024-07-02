@if(isset($vehicles) && count($vehicles) > 0)
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6">Detalhes dos Carros Externos</h2>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr class="bg-gray-100">
                <th class="py-3 px-4 border-b text-left text-gray-600">Matricula</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Preço de Aluguer por Dia</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Empresa de Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início do Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Data de Fim do Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Custo Total de Aluguer</th>
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
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold">Total de Veículos:</td>
                    <td class="py-3 px-4 border-b font-semibold">{{ $totalVehicles }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold">Total de Custos:</td>
                    <td class="py-3 px-4 border-b font-semibold">{{ number_format($totalCost, 2) }}</td>
                </tr>
            </tfoot>
        </table>
        <form action="{{ route('external.car.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-green-500 text-sm">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr class="bg-gray-100">
                <th class="py-3 px-4 border-b text-left text-gray-600">Matricula</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Preço de Aluguer por Dia</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Empresa de Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início do Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Data de Fim do Aluguer</th>
                <th class="py-3 px-4 border-b text-left text-gray-600">Custo Total de Aluguer</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-3 px-4 border-b text-center text-gray-500" colspan="6">Nenhum carro externo encontrado</td>
            </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold">Total de Veículos:</td>
                    <td class="py-3 px-4 border-b font-semibold">{{ $totalVehicles }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="py-3 px-4 border-b text-right font-semibold">Total de Custos:</td>
                    <td class="py-3 px-4 border-b font-semibold">{{ number_format($totalCost, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endif

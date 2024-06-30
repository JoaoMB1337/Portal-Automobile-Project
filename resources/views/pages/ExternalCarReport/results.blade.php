@if(isset($vehicles) && count($vehicles) > 0)
    <div class="mt-8 bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl mb-4">Detalhes dos Carros Externos</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Matricula</th>
                <th class="py-2 px-4 border-b">Preço de Aluguer por Dia</th>
                <th class="py-2 px-4 border-b">Empresa de Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Início do Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Fim do Aluguer</th>
                <th class="py-2 px-4 border-b">Custo Total de Aluguer</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vehicles as $vehicle)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $vehicle->plate }}</td>
                    <td class="py-2 px-4 border-b">{{ $vehicle->rental_price_per_day }}</td>
                    <td class="py-2 px-4 border-b">{{ $vehicle->rental_company }}</td>
                    <td class="py-2 px-4 border-b">{{ $vehicle->rental_start_date }}</td>
                    <td class="py-2 px-4 border-b">{{ $vehicle->rental_end_date }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($vehicle->total_rental_cost, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('external.car.report.generate') }}" method="GET" style="display:inline;">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <table class="min-w-full bg-white rounded-2xl">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Matricula</th>
                <th class="py-2 px-4 border-b">Preço de Aluguer por Dia</th>
                <th class="py-2 px-4 border-b">Empresa de Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Início do Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Fim do Aluguer</th>
                <th class="py-2 px-4 border-b">Custo Total de Aluguer</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td class="py-2 px-4 border-b" colspan="6">Nenhum carro externo encontrado</td>
        </tr>
        </tbody>
    </table>
@endif

@if(isset($costs) && count($costs) > 0)
    <div class="mt-8 bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl mb-4">Detalhes dos Custos</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Tipo de Custo</th>
                <th class="py-2 px-4 border-b">Valor</th>
                <th class="py-2 px-4 border-b">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($costs as $cost)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $cost->costType->type_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $cost->cost }}</td>
                    <td class="py-2 px-4 border-b">{{ $cost->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('cost.report.generate') }}" method="GET" style="display:inline;">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="mt-4 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <table class="min-w-full bg-white rounded-2xl">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Tipo de Custo</th>
            <th class="py-2 px-4 border-b">Valor</th>
            <th class="py-2 px-4 border-b">Data</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="py-2 px-4 border-b" colspan="3">Nenhum custo encontrado</td>
        </tr>
        </tbody>
    </table>
@endif

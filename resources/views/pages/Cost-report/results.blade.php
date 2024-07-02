@if(isset($costs) && $costs->count() > 0)
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl mb-4 font-semibold">Detalhes dos Custos</h2>
        <p class="mb-4 text-gray-600">Total de Custos: {{ $costs->sum('cost') }}</p>
        <p class="mb-4 text-gray-600">Total de Resultados: {{ $costs->total() }}</p>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Tipo de Custo</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Valor</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($costs as $cost)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">{{ $cost->costType->type_name }}</td>
                    <td class="py-3 px-4 border-b">{{ $cost->cost }}</td>
                    <td class="py-3 px-4 border-b">{{ $cost->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $costs->links() }} <!-- Paginação -->
        <form action="{{ route('cost.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-500">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Tipo de Custo</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Valor</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Data</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-3 px-4 border-b" colspan="3" class="text-center text-gray-500">Nenhum custo encontrado</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif

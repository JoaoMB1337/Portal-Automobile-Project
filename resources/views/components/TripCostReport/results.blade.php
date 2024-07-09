@if(isset($costs) && $costs->count() > 0)
    <div class="mt-8 bg-white p-2 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl text-gray-800 mb-6">Detalhes dos Custos</h2>
        <p class="mb-4 text-gray-700">Total de Custos: <span class="font-semibold">{{ $costs->sum('cost') }}</span></p>
        <p class="mb-4 text-gray-700">Total de Resultados: <span class="font-semibold">{{ $costs->total() }}</span></p>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Projeto</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Viagem</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de Custo</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($costs as $cost)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b text-gray-700">{{ $cost->trip->project->name }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">{{ $cost->trip->destination }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">{{ $cost->costType->type_name }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">{{ $cost->cost }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">{{ $cost->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $costs->appends(request()->query())->links() }}
        </div>
        <form action="{{ route('cost.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Projeto</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Viagem</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de Custo</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="3">Nenhum custo encontrado</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif
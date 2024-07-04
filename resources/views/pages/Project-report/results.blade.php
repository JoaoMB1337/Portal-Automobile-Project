@if($trips->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detalhes das Viagens</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Destino</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de Custo</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($trips as $trip)
                    @foreach ($trip->tripDetails as $detail)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b text-gray-700">{{ $trip->destination }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $detail->costType->type_name }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ number_format($detail->cost, 2, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $detail->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr class="font-bold">
                    <td class="py-3 px-4 border-b text-gray-700" colspan="2">Total de Viagens</td>
                    <td class="py-3 px-4 border-b text-gray-700">{{ $tripCount }}</td>
                    <td class="py-3 px-4 border-b"></td>
                </tr>
                <tr class="font-bold">
                    <td class="py-3 px-4 border-b text-gray-700" colspan="2">Custo Total</td>
                    <td class="py-3 px-4 border-b text-gray-700">{{ number_format($totalCost, 2, ',', '.') }}</td>
                    <td class="py-3 px-4 border-b"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $trips->appends(request()->input())->links() }}
        </div>
        <form action="{{ route('project.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="project_id" value="{{ $projectId }}">
            <button type="submit" class="w-full  bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Destino</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de Custo</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="4">Nenhuma viagem encontrada</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

@if(isset($trips) && count($trips) > 0)
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl mb-4 font-semibold">Detalhes das Viagens</h2>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Destino</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Tipo de Custo</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Valor</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Data</th>
            </tr>
            </thead>
            <tbody>
            @php
                $totalCost = 0;
            @endphp
            @foreach ($trips as $trip)
                @foreach ($trip->tripDetails as $detail)
                    @php
                        $totalCost += $detail->cost;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $trip->destination }}</td>
                        <td class="py-3 px-4 border-b">{{ $detail->costType->type_name }}</td>
                        <td class="py-3 px-4 border-b">{{ $detail->cost }}</td>
                        <td class="py-3 px-4 border-b">{{ $detail->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tr class="font-bold">
                <td class="py-3 px-4 border-b" colspan="2">Custo Total</td>
                <td class="py-3 px-4 border-b">{{ $totalCost }}</td>
                <td class="py-3 px-4 border-b"></td>
            </tr>
            </tbody>
        </table>
        <form action="{{ route('project.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="project_id" value="{{ $projectId }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-500">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
            <tr>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Destino</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Tipo de Custo</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Valor</th>
                <th class="py-3 px-4 border-b bg-gray-100 text-left text-gray-600">Data</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-3 px-4 border-b" colspan="4" class="text-center text-gray-500">Nenhuma viagem encontrada</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif

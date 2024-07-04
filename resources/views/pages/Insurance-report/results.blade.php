@if(isset($insurances) && count($insurances) > 0)
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl mb-4 font-semibold">Detalhes dos Seguros</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de Seguros</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Número da Apólice</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Término</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($insurances as $insurance)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $insurance->insurance_company }}</td>
                        <td class="py-3 px-4 border-b">{{ $insurance->policy_number }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($insurance->start_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($insurance->end_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ $insurance->vehicle->plate }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($insurance->cost, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <p>Total de Seguros: {{ $totalResults }}</p>
            <p>Custo Total: {{ number_format($totalCost, 2, ',', '.') }}</p>
        </div>
        <div class="mt-4">
            {{ $insurances->appends(request()->input())->links() }}
        </div>
        <form action="{{ route('insurance.report.generate') }}" method="GET" class="mt-6">
            @csrf
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <button type="submit" class="w-full  bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Baixar Relatório em PDF</button>
        </form>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de Seguros</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Número da Apólice</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Término</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="6">Nenhum seguro encontrado</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

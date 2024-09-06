@if ($insurances->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detalhes dos seguros</h2>

        <!-- Resumo dos seguros -->
        <div class="mb-6">
            <span class="text-xl font-bold text-gray-700">Total de seguros:</span>
            <span class="text-xl font-semibold text-green-600">{{ $totalResults }}</span>
        </div>
        <div class="mb-6">
            <span class="text-xl font-bold text-gray-700">Custo total dos seguros:</span>
            <span class="text-xl font-semibold text-green-600">{{ $totalCost }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de seguros</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Número da apólice</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Data de início</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Data de término</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insurances as $insurance)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">
                                {{ $insurance->insurance_company ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $insurance->policy_number ?? 'N/A'}}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ \Carbon\Carbon::parse($insurance->start_date)->format('d/m/Y') ?? 'N/A'}}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ \Carbon\Carbon::parse($insurance->end_date)->format('d/m/Y') ?? 'N/A'}}
                            </td>
                            <td class="py-3 px-4 border-b">
                                {{ $insurance->vehicle->plate ?? 'N/A' }}
                                </td>
                            <td class="py-3 px-4 border-b">
                                {{ number_format($insurance->cost, 2, ',', '.') ?? 'N/A'}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão para download do PDF -->
        <div class="mt-6 text-right">
            <form action="{{ route('insurance.report.generate') }}" method="GET">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Baixar relatório PDF</button>
            </form>
        </div>

        <div class="mt-6">
            {{ $insurances->appends(request()->input())->links() }}
        </div>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de seguros</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Número da apólice</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Data de início</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Data de término</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6"
                            class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado"
                                class="w-64 h-64 mx-auto">
                            <p class="mt-4 text-center">Nenhum seguro encontrado</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

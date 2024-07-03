@if($trips->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Resumo dos Custos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de Custo</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Custo Total</th>
                    <th class="py-3 px-4 border-b"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($costTypesSummary as $summary)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b text-gray-700">{{ $summary['type_name'] }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">{{ number_format($summary['total_cost'], 2, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b text-gray-700">
                            <button class="expand-details bg-blue-500 text-white px-2 py-1 rounded">Expandir</button>
                        </td>
                    </tr>
                    <tr class="details hidden">
                        <td colspan="3">
                            <div class="p-4">
                                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                    <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-3 px-4 border-b text-left text-gray-700">Destino</th>
                                        <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                                        <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                                        <th class="py-3 px-4 border-b text-left text-gray-700">Comprovante</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($summary['details'] as $detail)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b text-gray-700">{{ $detail->trip->destination }}</td>
                                            <td class="py-3 px-4 border-b text-gray-700">{{ number_format($detail->cost, 2, ',', '.') }}</td>
                                            <td class="py-3 px-4 border-b text-gray-700">{{ $detail->created_at->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b text-gray-700">
                                                @if($detail->file)
                                                    <a href="{{ asset('storage/' . $detail->file) }}" target="_blank" class="text-blue-500">Ver Comprovante</a>
                                                @else
                                                    <span class="text-gray-500">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $trips->appends(request()->input())->links() }}
        </div>
    </div>

    <script>
        document.querySelectorAll('.expand-details').forEach(button => {
            button.addEventListener('click', function() {
                const detailsRow = this.closest('tr').nextElementSibling;
                detailsRow.classList.toggle('hidden');
            });
        });
    </script>
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
                    <th class="py-3 px-4 border-b text-left text-gray-700">Comprovante</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="5">Nenhuma viagem encontrada</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

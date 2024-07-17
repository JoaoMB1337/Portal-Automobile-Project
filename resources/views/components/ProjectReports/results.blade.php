@if ($trips->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Resumo dos custos</h2>

        <!-- Novo bloco para exibir o custo total do projeto -->
        <div class="mb-6">
            <span class="text-xl font-bold text-gray-700">Custo total do projeto:</span>
            <span class="text-xl font-semibold text-green-600">{{ number_format($totalCost, 2, ',', '.') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de custo</th>
                        <th class="py-3 px-4 border-b text-left text-gray-700">Custo total</th>
                        <th class="py-3 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($costTypesSummary as $summary)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b text-gray-700">{{ $summary['type_name'] }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ number_format($summary['total_cost'], 2, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                <button
                                    class="expand-details bg-blue-500 text-white px-2 py-1 rounded">Expandir</button>
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
                                                    <td class="py-3 px-4 border-b text-gray-700">
                                                        {{ $detail->trip->destination }}</td>
                                                    <td class="py-3 px-4 border-b text-gray-700">
                                                        {{ number_format($detail->cost, 2, ',', '.') }}</td>
                                                    <td class="py-3 px-4 border-b text-gray-700">
                                                        {{ $detail->created_at->format('d/m/Y') }}</td>
                                                    <td class="py-3 px-4 border-b text-gray-700">
                                                        @if ($detail->file)
                                                            <a href="{{ asset('storage/' . $detail->file) }}"
                                                                target="_blank" class="text-blue-500">Ver
                                                                comprovante</a>
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

        <!-- Botão para download do PDF -->
        <div class="mt-6 text-right">
            <a href="{{ route('project.report.generate', ['project_id' => $projectId]) }}"
                class="bg-green-500 text-white px-4 py-2 rounded">Baixar relatório PDF</a>
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
                        <th class="py-3 px-4 border-b text-left text-gray-700">Tipo de custo</th>
                        <th class="py-3 px-4 border-b text-left text-gray-700">Valor</th>
                        <th class="py-3 px-4 border-b text-left text-gray-700">Data</th>
                        <th class="py-3 px-4 border-b text-left text-gray-700">Comprovante</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5"
                            class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado"
                                class="w-64 h-64 mx-auto">
                            <p class="mt-4 text-center">Nenhum projeto encontrado</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif

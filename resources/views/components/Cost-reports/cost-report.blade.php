<div class="mx-auto lg:pl-64">
    <h1>Gerar Relatório de Custos</h1>
    <form action="{{ route('index') }}" method="GET">
        @csrf
        <label for="start_date">Data Inicial:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ request('start_date') }}">
        <br>
        <label for="end_date">Data Final:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ request('end_date') }}">
        <br>
        <button type="submit">Filtrar</button>
    </form>

    @if(isset($costs) && count($costs) > 0)
        <h2>Detalhes dos Custos</h2>
        <table>
            <thead>
            <tr>
                <th>Tipo de Custo</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($costs as $cost)
                <tr>
                    <td>{{ $cost->costType->type_name }}</td>
                    <td>{{ $cost->cost }}</td>
                    <td>{{ $cost->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('cost.report.generate') }}" method="GET" style="display:inline;">
            @csrf
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <button type="submit">Baixar Relatório em PDF</button>
        </form>
    @else
        <p>Nenhum custo encontrado para o período selecionado.</p>
    @endif
</div>

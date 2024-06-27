
    <div class="mx-auto lg:pl-64">
        <h1>Gerar Relatório de Carros Externos</h1>
        <form action="{{ route('external.car.report.index') }}" method="GET">
            @csrf
            <label for="start_date">Data Inicial:</label>
            <input type="date" id="start_date" name="start_date" required value="{{ request('start_date') }}">
            <br>
            <label for="end_date">Data Final:</label>
            <input type="date" id="end_date" name="end_date" required value="{{ request('end_date') }}">
            <br>
            <button type="submit">Filtrar</button>
        </form>

        @if(isset($vehicles) && count($vehicles) > 0)
            <h2>Detalhes dos Carros Externos</h2>
            <table>
                <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Preço de Aluguer por Dia</th>
                    <th>Empresa de Aluguer</th>
                    <th>Data de Início do Aluguer</th>
                    <th>Data de Fim do Aluguer</th>
                    <th>Custo Total de Aluguer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->plate }}</td>

                        <td>{{ $vehicle->rental_price_per_day }}</td>
                        <td>{{ $vehicle->rental_company }}</td>
                        <td>{{ $vehicle->rental_start_date }}</td>
                        <td>{{ $vehicle->rental_end_date }}</td>
                        <<td>{{ number_format($vehicle->total_rental_cost, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="{{ route('external.car.report.generate') }}" method="GET">
                @csrf
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit">Baixar Relatório em PDF</button>
            </form>
        @else
            <p>Nenhum carro externo encontrado para o período selecionado.</p>
        @endif
    </div>


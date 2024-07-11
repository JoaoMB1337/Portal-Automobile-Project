<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Custos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tfoot { font-weight: bold; }
        .total-row td { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Relatório de Custos</h1>
    <h2>Período: {{ $start_date }} até {{ $end_date }}</h2>

    <h2>Detalhes dos Custos</h2>
    <table>
        <thead>
            <tr>
                <th>Projeto</th>
                <th>Viagem</th>
                <th>Veículo</th>
                <th>Tipo de Custo</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($costs as $cost)
                <tr>
                    <td>{{ $cost->trip->project->name ?? 'N/A' }}</td>
                    <td>{{ $cost->trip->destination ?? 'N/A' }}</td>
                    <td>{{ $cost->trip->vehicles->first()->plate ?? 'N/A' }}</td>
                    <td>{{ $cost->costType->type_name ?? 'N/A' }}</td>
                    <td>{{ number_format($cost->cost, 2, ',', '.') }}</td>
                    <td>{{ $cost->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total de Custos:</td>
                <td>{{ number_format($totalCost, 2, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

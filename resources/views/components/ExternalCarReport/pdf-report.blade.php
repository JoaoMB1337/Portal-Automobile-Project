<!DOCTYPE html>
<html>

<head>
    <title>Relatório de carros externos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot tr td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>>Relatório de carros externos</h1>
    <h2>Período: {{ $start_date }} até {{ $end_date }}</h2>

    <h2>Detalhes dos carros externos</h2>
    <table>
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Preço de aluguer por dia</th>
                <th>Empresa de aluguer</th>
                <th>Data de início do aluguer</th>
                <th>Data de fim do aluguer</th>
                <th>Custo total de aluguer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->plate }}</td>
                    <td>{{ number_format($vehicle->rental_price_per_day, 2, ',', '.') }}</td>
                    <td>{{ $vehicle->rental_company }}</td>
                    <td>{{ $vehicle->rental_start_date }}</td>
                    <td>{{ $vehicle->rental_end_date }}</td>
                    <td>{{ number_format($vehicle->total_rental_cost, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right;">Total de veículos:</td>
                <td>{{ $vehicles->count() }}</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;">Total de custos:</td>
                <td>{{ number_format($totalCost, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>

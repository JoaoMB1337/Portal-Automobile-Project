<!DOCTYPE html>
<html>

<head>
    <title>Relatório de seguros</title>
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
    </style>
</head>

<body>
    <h1>Relatório de seguros</h1>
    <h2>Período: {{ $start_date->format('d/m/Y') }} até {{ $end_date->format('d/m/Y') }}</h2>

    <h2>Detalhes dos seguros</h2>
    <table>
        <thead>
            <tr>
                <th>Companhia de seguros</th>
                <th>Número da apólice</th>
                <th>Data de início</th>
                <th>Data de término</th>
                <th>Matrícula</th>
                <th>Custo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $insurance)
                <tr>
                    <td>{{ $insurance->insurance_company ?? 'N/A'}}</td>
                    <td>{{ $insurance->policy_number ?? 'N/A'}}</td>
                    <td>{{ \Carbon\Carbon::parse($insurance->start_date)->format('d/m/Y') ?? 'N/A'}}</td>
                    <td>{{ \Carbon\Carbon::parse($insurance->end_date)->format('d/m/Y') ?? 'N/A'}}</td>
                    <td>{{ $insurance->vehicle->plate ?? 'N/A'}}</td>
                    <td>{{ $insurance->cost ?? 'N/A'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

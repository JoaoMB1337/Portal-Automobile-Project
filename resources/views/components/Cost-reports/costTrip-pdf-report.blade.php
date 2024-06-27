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
    </style>
</head>
<body>
<h1>Relatório de Custos</h1>
<h2>Período: {{ $start_date }} até {{ $end_date }}</h2>

<h2>Detalhes dos Custos</h2>
<table>
    <thead>
    <tr>
        <th>Tipo de Custo</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Viagem</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($costs as $cost)
        <tr>
            <td>{{ $cost->costType->type_name }}</td>
            <td>{{ $cost->cost }}</td>
            <td>{{ $cost->created_at->format('d/m/Y') }}</td>
            <td>{{ $cost->trip ? $cost->trip->destination : 'N/A' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

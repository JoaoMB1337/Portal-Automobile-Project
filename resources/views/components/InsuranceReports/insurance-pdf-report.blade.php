<!DOCTYPE html>
<html>
<head>
    <title>Relatório de seguros</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Relatório de seguros</h1>
<h2>Período: {{ $start_date->format('d/m/Y') }} até {{ $end_date->format('d/m/Y') }}</h2>

<h2>Detalhes dos Seguros</h2>
<table>
    <thead>
    <tr>
        <th>Companhia de Seguros</th>
        <th>Número da Apólice</th>
        <th>Data de Início</th>
        <th>Data de Término</th>
        <th>Matrícula</th>
        <th>Custo</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($insurances as $insurance)
        <tr>
            <td>{{ $insurance->insurance_company }}</td>
            <td>{{ $insurance->policy_number }}</td>
            <td>{{ \Carbon\Carbon::parse($insurance->start_date)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($insurance->end_date)->format('d/m/Y') }}</td>
            <td>{{ $insurance->vehicle->plate }}</td>
            <td>{{ $insurance->cost }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

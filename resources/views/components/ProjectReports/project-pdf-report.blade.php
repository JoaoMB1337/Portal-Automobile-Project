<!DOCTYPE html>
<html>
<head>
    <title>Relatório de projetos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Relatório de Projetos</h1>
@if($project)
    <h2>Projeto: {{ $project->name }}</h2>
@endif

<h2>Detalhes das Viagens</h2>
<table>
    <thead>
    <tr>
        <th>Destino</th>
        <th>Tipo de Custo</th>
        <th>Valor</th>
        <th>Data</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totalCost = 0;
    @endphp
    @foreach ($trips as $trip)
        @foreach ($trip->tripDetails as $detail)
            @php
                $totalCost += $detail->cost;
            @endphp
            <tr>
                <td>{{ $trip->destination }}</td>
                <td>{{ $detail->costType->type_name }}</td>
                <td>{{ $detail->cost }}</td>
                <td>{{ $trip->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    @endforeach
    <tr class="font-bold">
        <td colspan="2">Custo Total</td>
        <td>{{ $totalCost }}</td>
        <td></td>
    </tr>
    </tbody>
</table>
</body>
</html>
<body class="bg-gray-100">
<div class="container mx-auto p-8">
    <form action="{{ route('external.car.report.index') }}" method="GET" class="bg-white p-6 rounded-2xl shadow-md">
        @csrf
        <h1 class="text-3xl  text-center mb-8">Gerar Relatório de Carros Externos</h1>

        <div class="mb-4">
            <label for="start_date" class="block text-gray-700">Data Inicial:</label>
            <input type="date" id="start_date" name="start_date" required value="{{ request('start_date') }}" class="mt-1 p-2 border rounded w-full">
        </div>
        <div class="mb-4">
            <label for="end_date" class="block text-gray-700">Data Final:</label>
            <input type="date" id="end_date" name="end_date" required value="{{ request('end_date') }}" class="mt-1 p-2 border rounded w-full">
        </div>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Filtrar</button>
    </form>

    @if(isset($vehicles) && count($vehicles) > 0)
        <div class="mt-8 bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl  mb-4">Detalhes dos Carros Externos</h2>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Matricula</th>
                    <th class="py-2 px-4 border-b">Preço de Aluguer por Dia</th>
                    <th class="py-2 px-4 border-b">Empresa de Aluguer</th>
                    <th class="py-2 px-4 border-b">Data de Início do Aluguer</th>
                    <th class="py-2 px-4 border-b">Data de Fim do Aluguer</th>
                    <th class="py-2 px-4 border-b">Custo Total de Aluguer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $vehicle->plate }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->rental_price_per_day }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->rental_company }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->rental_start_date }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->rental_end_date }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($vehicle->total_rental_cost, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="{{ route('external.car.report.generate') }}" method="GET" style="display:inline;">
                @csrf
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Baixar Relatório em PDF</button>
            </form>
        </div>
    @else
        <table class="min-w-full bg-white rounded-2xl">

        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Matricula</th>
                <th class="py-2 px-4 border-b">Preço de Aluguer por Dia</th>
                <th class="py-2 px-4 border-b">Empresa de Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Início do Aluguer</th>
                <th class="py-2 px-4 border-b">Data de Fim do Aluguer</th>
                <th class="py-2 px-4 border-b">Custo Total de Aluguer</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-4 border-b" colspan="6">Nenhum carro externo encontrado</td>
            </tr>
            </tbody>
    @endif
</div>
</body>

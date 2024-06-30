<form action="{{ route('external.car.report.index') }}" method="POST" class="bg-white p-6 rounded-2xl shadow-md">
    @csrf
    <h1 class="text-3xl text-center mb-8">Gerar Relatório de Carros Externos</h1>

    <div class="mb-4">
        <label for="start_date" class="block text-gray-700">Data Inicial:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $startDate) }}" class="mt-1 p-2 border rounded w-full">
    </div>
    <div class="mb-4">
        <label for="end_date" class="block text-gray-700">Data Final:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ old('end_date', $endDate) }}" class="mt-1 p-2 border rounded w-full">
    </div>
    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Filtrar</button>
</form>

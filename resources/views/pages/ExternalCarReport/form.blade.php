<form action="{{ route('external.car.report.index') }}" method="POST" class="bg-white p-10 rounded-lg shadow-md max-w-xl mx-auto">
    @csrf
    <h1 class="text-3xl  text-center text-gray-800 mb-6">Gerar Relatório de Carros Externos</h1>

    <div class="mb-5">
        <label for="start_date" class="block text-gray-700 text-sm font-medium mb-2">Data Inicial:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $startDate) }}" class="block w-full p-3 border border-gray-300 rounded-md focus:ring-gray-400 focus:border-gray-400 text-sm">
        @error('start_date')
        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="end_date" class="block text-gray-700 text-sm font-medium mb-2">Data Final:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ old('end_date', $endDate) }}" class="block w-full p-3 border border-gray-300 rounded-md focus:ring-gray-400 focus:border-gray-400 text-sm">
        @error('end_date')
        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="w-full bg-gray-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gray-500 text-sm font-medium">Filtrar</button>
</form>

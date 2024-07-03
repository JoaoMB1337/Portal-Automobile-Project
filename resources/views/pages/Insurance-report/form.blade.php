<form action="{{ route('insurance.report.filter') }}" method="POST" class="bg-white p-10 rounded-lg shadow-sm max-w-md mx-auto">
    @csrf
    <h1 class="text-3xl text-center mb-6">Gerar Relatório de Seguros</h1>

    <div class="mb-4">
        <label for="start_date" class="block text-gray-600 text-sm font-medium ">Data Inicial:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $startDate) }}" class="mt-1 p-3 border border-gray-300 rounded w-full text-sm">
        @error('start_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="end_date" class="block text-gray-600 text-sm">Data Final:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ old('end_date', $endDate) }}" class="mt-1 p-3 border border-gray-300 rounded w-full text-sm">
        @error('end_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="w-full  bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Pesquisar</button>
</form>

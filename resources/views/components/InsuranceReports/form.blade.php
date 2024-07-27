<form action="{{ route('insurance.report.filter') }}" method="POST"
    class="bg-white p-10 rounded-lg shadow-sm max-w-md mx-auto">
    @csrf
    <h1 class="text-3xl text-center mb-6">Gerar relatório de seguros</h1>

    <div class="mb-4">
        <label for="start_date" class="block text-gray-600 text-sm font-medium ">Data inicial:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $startDate) }}"
            class="mt-1 p-3 border border-gray-300 rounded w-full text-sm">
        @error('start_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="end_date" class="block text-gray-600 text-sm">Data final:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ old('end_date', $endDate) }}"
            class="mt-1 p-3 border border-gray-300 rounded w-full text-sm">
        @error('end_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-center mt-4">
        <button type="submit"
                class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
            Pesquisar
        </button>
    </div></form>

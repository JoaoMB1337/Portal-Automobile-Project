<form action="{{ route('cost.report.filter') }}" method="POST"
    class="bg-white p-10 rounded-lg shadow-md max-w-lg mx-auto space-y-6">
    @csrf
    <h1 class="text-3xl text-center text-gray-800 mb-6 ">Relatórios de custos das viagens</h1>

    <div class="mb-5">
        <label for="start_date" class="block text-gray-600 text-sm font-medium mb-2">Data inicial:</label>
        <div class="relative">
            <input type="date" id="start_date" name="start_date" required value="{{ old('start_date', $startDate) }}"
                class="block w-full p-3 border border-gray-300 rounded-md focus:ring-gray-400 focus:border-gray-400 text-sm">
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H5a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zM4 7h12v9a1 1 0 01-1 1H5a1 1 0 01-1-1V7zm8 4a1 1 0 10-2 0v3a1 1 0 102 0v-3z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </div>
        @error('start_date')
            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="end_date" class="block text-gray-600 text-sm font-medium mb-2">Data final:</label>
        <div class="relative">
            <input type="date" id="end_date" name="end_date" required value="{{ old('end_date', $endDate) }}"
                   class="block w-full p-3 border border-gray-300 rounded-md focus:ring-gray-400 focus:border-gray-400 text-sm">
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M6 2a1 1 0 00-1 1v1H5a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zM4 7h12v9a1 1 0 01-1 1H5a1 1 0 01-1-1V7zm8 4a1 1 0 10-2 0v3a1 1 0 102 0v-3z"
                      clip-rule="evenodd" />
            </svg>
        </span>
        </div>
        @error('end_date')
        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-center mt-4">
        <button type="submit"
                class="flex items-center px-4 py-2 bg-green-700 hover:bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
            Pesquisar
        </button>
    </div>

</form>

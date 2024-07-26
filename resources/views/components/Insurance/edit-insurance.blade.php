<style>
    .custom-card {
        background-color: #ffffff;
        box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }

    .custom-btn {
        background-color: #000;
        color: #fff;
        transition: background-color 0.3s ease;
        border-radius: 30px;
    }

    .custom-btn:hover {
        background-color: #222;
    }

    .form-input,
    .form-control {
        border: 2px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-input:focus,
    .form-control:focus {
        border-color: #888;
    }
</style>

<body>

    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex items-center justify-between mb-4">
                @include('components.ButtonComponents.backButton')
                <div class="text-lg leading-6 font-medium text-gray-900">
                    <h1>Editar seguro</h1>
                </div>
                <div class="w-10 h-10"></div>
            </div>

            <form method="POST" action="{{ route('insurances.update', $insurance->id) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="insurance_company" class="block text-sm font-semibold text-gray-700 mb-2">Companhia de
                        seguros</label>
                    <input id="insurance_company" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('insurance_company') border-red-500 @enderror"
                        name="insurance_company" value="{{ old('insurance_company', $insurance->insurance_company) }}"
                        required>
                    @error('insurance_company')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="policy_number" class="block text-sm font-semibold text-gray-700 mb-2">Número da
                        apólice</label>
                    <input id="policy_number" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('policy_number') border-red-500 @enderror"
                        name="policy_number" value="{{ old('policy_number', $insurance->policy_number) }}" required>
                    @error('policy_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de
                        início</label>
                    <input id="start_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('start_date') border-red-500 @enderror"
                        name="start_date" value="{{ old('start_date', $insurance->start_date) }}" required>
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de fim</label>
                    <input id="end_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('end_date') border-red-500 @enderror"
                        name="end_date" value="{{ old('end_date', $insurance->end_date) }}" required>
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo</label>
                    <input id="cost" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror"
                        name="cost" value="{{ old('cost', number_format($insurance->cost, 2, ',', '.')) }}" required>
                    @error('cost')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="vehicle_plate" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                    <input id="vehicle_plate" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('vehicle_plate') border-red-500 @enderror"
                        name="vehicle_plate" value="{{ old('vehicle_plate', $insurance->vehicle->plate ?? '') }}"
                        required>
                    @error('vehicle_plate')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        Atualizar
                    </button>
                    <a href="{{ url('insurances') }}"
                        class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

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
</head>

<body>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="w-full max-w-md bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('insurances.index') }}" class="flex items-center">
                <button type="button" class="flex items-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <div class="flex-grow text-center">
                <h1>Editar Seguro</h1>
            </div>
            <div class="w-10 h-10"></div>
        </div>

        <form method="POST" action="{{ route('insurances.update', $insurance->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="insurance_company" class="block text-sm font-semibold text-gray-700 mb-2">Companhia de Seguros</label>
                <input id="insurance_company" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('insurance_company') border-red-500 @enderror" name="insurance_company" value="{{ old('insurance_company', $insurance->insurance_company) }}" required>
                @error('insurance_company')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="policy_number" class="block text-sm font-semibold text-gray-700 mb-2">Número da Apólice</label>
                <input id="policy_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('policy_number') border-red-500 @enderror" name="policy_number" value="{{ old('policy_number', $insurance->policy_number) }}" required>
                @error('policy_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de Início</label>
                <input id="start_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('start_date') border-red-500 @enderror" name="start_date" value="{{ old('start_date', $insurance->start_date) }}" required>
                @error('start_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de Fim</label>
                <input id="end_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('end_date') border-red-500 @enderror" name="end_date" value="{{ old('end_date', $insurance->end_date) }}" required>
                @error('end_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo</label>
                <input id="cost" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror" name="cost" value="{{ old('cost', number_format($insurance->cost, 2, ',', '.')) }}" required>
                @error('cost')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="vehicle_plate" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                <input id="vehicle_plate" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('vehicle_plate') border-red-500 @enderror" name="vehicle_plate" value="{{ old('vehicle_plate', $insurance->vehicle->plate ?? '') }}" required>
                @error('vehicle_plate')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                    Atualizar
                </button>
            </div>
        </form>

    </div>
</div>

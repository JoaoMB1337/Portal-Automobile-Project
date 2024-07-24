@vite(['resources/js/Trips/create.js'])
<body class="custom-bg">
    <div class="flex justify-center items-start h-screen">
        <div class="w-full max-w-md bg-white rounded-xl p-7 custom-card mt-6">
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('insurances.index') }}">
                    <button type="button"
                        class="flex items-center justify-center w-1/2 mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                        <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </button>
                </a>
                <div class="text-center flex-grow mb-6">
                    <h1>Registo de seguros</h1>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('insurances.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="insurance_company" class="block text-sm font-semibold text-gray-700 mb-2">Companhia de
                        seguros</label>
                    <input id="insurance_company" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('insurance_company') border-red-500 @enderror"
                        name="insurance_company" value="{{ old('insurance_company') }}" required>
                    @error('insurance_company')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="policy_number" class="block text-sm font-semibold text-gray-700 mb-2">Número da apólice
                        de
                        seguro</label>
                    <input id="policy_number" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('policy_number') border-red-500 @enderror"
                        name="policy_number" value="{{ old('policy_number') }}" required>
                    @error('policy_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de
                        início</label>
                    <input id="start_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('start_date') border-red-500 @enderror"
                        name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de fim</label>
                    <input id="end_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('end_date') border-red-500 @enderror"
                        name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo total</label>
                    <input id="cost" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror"
                        name="cost" value="{{ old('cost', number_format((float) old('cost'), 2, ',', '.')) }}"
                        required>
                    @error('cost')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="search_vehicle" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                    <input id="search_vehicle" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('vehicle_plate') border-red-500 @enderror"
                        name="vehicle_plate" value="{{ old('vehicle_plate') }}" required readonly>
                    @error('vehicle_plate')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Veículo</label>
                    <select name="vehicle_id" id="vehicle_id"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('vehicle_id') border-red-500 @enderror">
                        <option value="" disabled selected>Selecione um veículo</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate }}
                            </option>
                        @endforeach
                    </select>
                    <div id="vehicle-error" class="text-red-500">{{ session('vehicle_error') }}</div>
                    @error('vehicle_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>


                <div class="flex justify-center mt-6">
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                        Registar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var urlParams = new URLSearchParams(window.location.search);
            var vehicleId = urlParams.get('vehicle_id');
            
            var vehicles = @json($vehicles);
            
            if (vehicleId) {
                var selectedVehicle = vehicles.find(vehicle => vehicle.id == vehicleId);
                if (selectedVehicle) {
                    var vehiclePlateInput = document.getElementById('search_vehicle');
                    vehiclePlateInput.value = selectedVehicle.plate;
                    vehiclePlateInput.readOnly = true;

                    var vehicleSelect = document.getElementById('vehicle_id');
                    vehicleSelect.value = selectedVehicle.id;
                }
            }
        });
    </script>
</body>
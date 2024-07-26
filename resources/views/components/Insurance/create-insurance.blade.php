<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Registo de Seguros</title>
    @vite(['resources/js/Trips/create.js'])
    <style>
        /* Adicione seus estilos aqui, se necessário */
    </style>
</head>
<body class="custom-bg">
    <div class="flex justify-center items-start h-screen">
        <div class="w-full max-w-md bg-white rounded-xl p-7 custom-card mt-6">
            <div class="flex items-center justify-between mb-4">
                <!-- Back Button Component -->
                @include('components.ButtonComponents.backButton')
                <div class="text-center flex-grow mb-6">
                    <h1>Registo de seguros</h1>
                </div>
            </div>

            <!-- Display session error messages -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erro:</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('insurances.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="insurance_company" class="block text-sm font-semibold text-gray-700 mb-2">Companhia de seguros</label>
                    <input id="insurance_company" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('insurance_company') border-red-500 @enderror"
                        name="insurance_company" value="{{ old('insurance_company') }}" required>
                    @error('insurance_company')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="policy_number" class="block text-sm font-semibold text-gray-700 mb-2">Número da apólice de seguro</label>
                    <input id="policy_number" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('policy_number') border-red-500 @enderror"
                        name="policy_number" value="{{ old('policy_number') }}" required>
                    @error('policy_number')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de início</label>
                    <input id="start_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('start_date') border-red-500 @enderror"
                        name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de fim</label>
                    <input id="end_date" type="date"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('end_date') border-red-500 @enderror"
                        name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">Custo total</label>
                    <input id="cost" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('cost') border-red-500 @enderror"
                        name="cost" value="{{ old('cost', number_format((float) old('cost'), 2, ',', '.')) }}" required>
                    @error('cost')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="search_vehicle" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                    <input id="search_vehicle" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('vehicle_plate') border-red-500 @enderror"
                        value="{{ old('vehicle_plate') }}" readonly>
                    @error('vehicle_plate')
                        <p class="text-red-500 text-xs mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="vehicle_id" id="vehicle_id">

                <div class="form-group">
                    <label for="vehicle_select" class="block text-sm font-medium text-gray-700">Veículo</label>
                    <select id="vehicle_select"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('vehicle_id') border-red-500 @enderror">
                        <option value="" disabled selected>Selecione um veículo</option>
                    </select>
                    <div id="vehicle-error" class="text-red-500 mt-1">{{ session('vehicle_error') }}</div>
                    @error('vehicle_id')
                        <div class="text-red-500 mt-1 bg-red-50 border border-red-300 p-2 rounded">{{ $message }}</div>
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

    <!-- Include vehicles data in a script tag -->
    <script type="application/json" id="vehicles-data">@json($vehicles)</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vehicles = JSON.parse(document.getElementById('vehicles-data').textContent);
            const searchInput = document.getElementById('search_vehicle');
            const vehicleSelect = document.getElementById('vehicle_select');
            const vehicleIdInput = document.getElementById('vehicle_id');

            function filterVehicles() {
                const searchValue = searchInput.value.toLowerCase();
                vehicleSelect.innerHTML = '<option value="" disabled selected>Selecione um veículo</option>';

                let foundMatch = false;

                vehicles.forEach(vehicle => {
                    if (vehicle.plate.toLowerCase().includes(searchValue)) {
                        const option = document.createElement('option');
                        option.value = vehicle.id;
                        option.text = vehicle.plate;
                        vehicleSelect.appendChild(option);

                        if (!foundMatch) {
                            vehicleSelect.value = vehicle.id;
                            foundMatch = true;
                        }
                    }
                });

                if (!foundMatch) {
                    vehicleSelect.value = "";
                }
            }

            searchInput.addEventListener('input', filterVehicles);

            vehicleSelect.addEventListener('change', function() {
                const selectedId = vehicleSelect.value;
                vehicleIdInput.value = selectedId;

                const selectedVehicle = vehicles.find(vehicle => vehicle.id == selectedId);
                if (selectedVehicle) {
                    searchInput.value = selectedVehicle.plate;
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            const vehicleId = urlParams.get('vehicle_id');

            if (vehicleId) {
                const selectedVehicle = vehicles.find(vehicle => vehicle.id == vehicleId);
                if (selectedVehicle) {
                    searchInput.value = selectedVehicle.plate;
                    searchInput.readOnly = true;

                    vehicleSelect.innerHTML = '<option value="" disabled>Selecione um veículo</option>';
                    const option = document.createElement('option');
                    option.value = selectedVehicle.id;
                    option.text = selectedVehicle.plate;
                    vehicleSelect.appendChild(option);
                    vehicleSelect.value = selectedVehicle.id;
                    vehicleSelect.disabled = true;
                    
                    vehicleIdInput.value = selectedVehicle.id;
                }
            } else {
                searchInput.readOnly = false;
                vehicleSelect.disabled = false;
            }
        });
    </script>
</body>
</html>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
        <a href="{{ route('trips.index') }}">
            <button type="button" class="flex items-center justify-center w-1/2 mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
            </button>
        </a>
        <div class="flex justify-center mb-6">
            <h1>Criar Viagem</h1>
        </div>
        <form method="POST" action="{{ route('trips.store') }}" class="space-y-6" id="trip-form">
            @csrf
            <div class="form-group mt-3">
                <label for="start_date">Data de Início:</label>
                <input type="date" name="start_date" id="start_date" class="form-input" required value="{{ old('start_date') }}">
                @error('start_date')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="end_date">Data de Fim:</label>
                <input type="date" name="end_date" id="end_date" class="form-input @error('end_date') border-red-500 @enderror" required value="{{ old('end_date') }}">
                @error('end_date')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="destination">Destino:</label>
                <input type="text" name="destination" class="form-input @error('destination') border-red-500 @enderror" required value="{{ old('destination') }}">
                @error('destination')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="purpose">Propósito da Viagem:</label>
                <textarea name="purpose" class="form-control @error('purpose') border-red-500 @enderror" required>{{ old('purpose') }}</textarea>
                @error('purpose')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="employee_id">Funcionário:</label>
                <select name="employee_id" class="form-control @error('employee_id') border-red-500 @enderror" required>
                    <option value="" disabled selected>Selecione um funcionário</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="project_id">Projeto:</label>
                <select name="project_id" class="form-control @error('project_id') border-red-500 @enderror" required {{ isset($project_id) ? 'disabled' : '' }}>
                    @if (isset($project_id))
                        <option value="{{ $project_id }}" selected>{{ $projects->firstWhere('id', $project_id)->name }}</option>
                    @else
                        <option value="" disabled selected>Selecione um projeto</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if (isset($project_id))
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                @endif
                @error('project_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type_trip_id">Tipo de Viagem:</label>
                <select name="type_trip_id" class="form-control @error('type_trip_id') border-red-500 @enderror" required>
                    <option value="" disabled selected>Selecione um tipo de viagem:</option>
                    @foreach ($typeTrips as $typeTrip)
                        <option value="{{ $typeTrip->id }}" {{ old('type_trip_id') == $typeTrip->id ? 'selected' : '' }}>{{ $typeTrip->type }}</option>
                    @endforeach
                </select>
                @error('type_trip_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="search_vehicle">Pesquisar Veículo por Matrícula:</label>
                <input type="text" name="search_vehicle" id="search_vehicle" class="form-control" value="{{ old('search_vehicle') }}">
            </div>
            <div class="form-group">
                <label for="vehicle_id">Veículo:</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') border-red-500 @enderror">
                    <option value="" disabled selected>Selecione um veículo</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate }}</option>
                    @endforeach
                </select>
                <div id="vehicle-error" class="text-red-500">{{ session('vehicle_error') }}</div>
                @error('vehicle_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" id="submit-button" class="custom-btn w-full py-2 rounded-md">
                    Criar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const vehicles = @json($vehicles);

    document.getElementById('search_vehicle').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const selectElement = document.getElementById('vehicle_id');

        selectElement.innerHTML = '<option value="" disabled selected>Selecione um veículo</option>';

        let foundMatch = false;

        vehicles.forEach(vehicle => {
            if (vehicle.plate.toLowerCase().includes(searchValue)) {
                const option = document.createElement('option');
                option.value = vehicle.id;
                option.text = vehicle.plate;
                selectElement.appendChild(option);

                if (!foundMatch) {
                    selectElement.value = vehicle.id;
                    foundMatch = true;
                }
            }
        });

        if (!foundMatch) {
            selectElement.value = "";
        }
    });

    document.getElementById('start_date').addEventListener('change', validateVehicleAvailability);
    document.getElementById('end_date').addEventListener('change', validateVehicleAvailability);
    document.getElementById('vehicle_id').addEventListener('change', validateVehicleAvailability);

    function validateVehicleAvailability() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const vehicleId = document.getElementById('vehicle_id').value;

        if (startDate && endDate && vehicleId) {
            fetch(`{{ url('api/check-vehicle-availability') }}?start_date=${startDate}&end_date=${endDate}&vehicle_id=${vehicleId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.available) {
                        document.getElementById('vehicle-error').innerText = 'O veículo já está em uso durante o período selecionado.';
                        document.getElementById('submit-button').disabled = true;
                    } else {
                        document.getElementById('vehicle-error').innerText = '';
                        document.getElementById('submit-button').disabled = false;
                    }
                });
        }
    }

    document.getElementById('trip-form').addEventListener('submit', function(event) {
        if (document.getElementById('vehicle-error').innerText) {
            event.preventDefault();
        }
    });
</script>

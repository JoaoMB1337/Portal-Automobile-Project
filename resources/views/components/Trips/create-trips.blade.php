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
            <h1>Trip</h1>
        </div>
        <form method="POST" action="{{ route('trips.store') }}" class="space-y-6">
            @csrf
            <div class="form-group mt-3">
                <label for="start_date">Data de Inicio:</label>
                <input type="date" name="start_date" class="form-input" required>
            </div>
            <div class="form-group mt-3">
                <label for="end_date">Data de Fim:</label>
                <input type="date" name="end_date" class="form-input @error('end_date') border-red-500 @enderror" required>
                @error('end_date')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="destination">Destino:</label>
                <input type="text" name="destination" class="form-input @error('destination') border-red-500 @enderror" required>
                @error('destination')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="purpose">Proposito da viagem:</label>
                <textarea name="purpose" class="form-control @error('purpose') border-red-500 @enderror" required></textarea>
                @error('purpose')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="employee_id">Funcionario:</label>
                <select name="employee_id" class="form-control @error('employee_id') border-red-500 @enderror" required>
                    <option value="" disabled selected>Selecione um funcionário</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
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
                <label for="type_trip_id">Tipo de viagem:</label>
                <select name="type_trip_id" class="form-control @error('type_trip_id') border-red-500 @enderror" required>
                    <option value="" disabled selected>Selecione um tipo de viagem:</option>
                    @foreach ($typeTrips as $typeTrip)
                        <option value="{{ $typeTrip->id }}">{{ $typeTrip->type }}</option>
                    @endforeach
                </select>
                @error('type_trip_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="search_vehicle">Pesquisar Veículo por Matrícula:</label>
                <input type="text" name="search_vehicle" id="search_vehicle" class="form-control">
            </div>
            <div class="form-group">
                <label for="vehicle_id">Veículo:</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') border-red-500 @enderror">
                    <option value="" disabled selected>Selecione um veículo</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate }}</option>
                    @endforeach
                </select>
                @error('vehicle_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="custom-btn w-full py-2 rounded-md">
                    Criar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('search_vehicle').addEventListener('input', function() {
        var searchValue = this.value.toLowerCase();
        var selectElement = document.getElementById('vehicle_id');

        selectElement.innerHTML = '';

        @foreach ($vehicles as $vehicle)
        var vehiclePlate = '{{ $vehicle->plate }}'.toLowerCase();
        if (vehiclePlate.includes(searchValue)) {
            var option = document.createElement('option');
            option.value = '{{ $vehicle->id }}';
            option.text = '{{ $vehicle->plate }}';
            selectElement.appendChild(option);
        }
        @endforeach
    });
</script>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex justify-center mb-6">
            <h1>Trip</h1>
        </div>
        <form method="POST" action="{{ route('trips.store') }}" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="start_date">Data de Início:</label>
                <input type="date" name="start_date" class="form-input" required>
            </div>
            <div class="form-group mt-3">
                <label for="end_date">Data de Fim:</label>
                <input type="date" name="end_date" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="destination">Destino:</label>
                <input type="text" name="destination" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="purpose">Proposito da viagem:</label>
                <textarea name="purpose" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="employee_id">Funcionario:</label>
                <select name="employee_id" class="form-control">
                    <option value="" disabled selected>Selecione um funcionário</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Projeto:</label>
                <select name="project_id" class="form-control @error('project_id') border-red-500 @enderror" required
                    {{ isset($project_id) ? 'disabled' : '' }}>
                    <option value="" disabled selected>Selecione um projeto</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ isset($project_id) && $project->id == $project_id ? 'selected' : '' }}>
                            {{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type_trip_id">Tipo de viagem:</label>
                <select name="type_trip_id" class="form-control">
                    <option value="" disabled selected>Selecione um tipo de viagem:</option>
                    @foreach ($typeTrips as $typeTrip)
                        <option value="{{ $typeTrip->id }}">{{ $typeTrip->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="search_vehicle">Pesquisar Veículo por Matrícula:</label>
                <input type="text" name="search_vehicle" id="search_vehicle" class="form-control">
            </div>

            <div class="form-group">
                <label for="vehicle_id">Veículo:</label>
                <select name="vehicle_id" id="vehicle_id" class="form-control"></select>
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
        const addVehicleButton = document.getElementById("addVehicleButton");
        const modal = document.getElementById("myModal");

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

        addVehicleButton.addEventListener("click", function() {
            modal.style.display = "block";
        });
    });
</script>

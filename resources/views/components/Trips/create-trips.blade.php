@vite(['resources/js/Trips/create.js'])
<script type="application/json" id="vehicles-data">@json($vehicles)</script>
<div id="employees-data" style="display: none;">{{ json_encode($employees) }}</div>

<div class="flex justify-center items-start h-screen custom-bg">
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="max-w-lg w-full bg-white rounded-xl shadow-md p-8 custom-card mt-12">
        @include('components.ButtonComponents.backButton')

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Criar viagem</h1>
            <p class="text-gray-600">Preencha os campos abaixo para criar uma nova viagem.</p>
        </div>

        @if (session('error'))
            <div class="text-red-500 mb-4 text-center">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('trips.store') }}" onsubmit="disableSubmitButton(event)"
        class="space-y-6" id="trip-form">
            @csrf
            <div class="form-group">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Data de início</label>
                <input type="date" name="start_date" id="start_date"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required
                    value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Data de fim</label>
                <input type="date" name="end_date" id="end_date"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('end_date') border-red-500 @enderror"
                    required value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                <input type="text" name="destination"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('destination') border-red-500 @enderror"
                    required value="{{ old('destination') }}">
                @error('destination')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="purpose" class="block text-sm font-medium text-gray-700">Propósito da viagem</label>
                <textarea name="purpose"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('purpose') border-red-500 @enderror"
                    required>{{ old('purpose') }}</textarea>
                @error('purpose')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>





            <div class="form-group">
                <label for="employee_name" class="block text-sm font-medium text-gray-700">Pesquisar funcionário</label>
                <input type="text" name="employee_name" id="employee_name"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    value="{{ old('employee_name') }}">
            </div>

            <div class="form-group">
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Funcionário</label>
                <select name="employee_id" id="employee_id"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('employee_id') border-red-500 @enderror"
                    required>
                    <option value="" disabled selected>Selecione um funcionário</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                <div id="employee-error" class="text-red-500">{{ session('employee_error') }}</div>
                @error('employee_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>



            <div class="form-group">
                <label for="project_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                <select name="project_id"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('project_id') border-red-500 @enderror"
                    required {{ isset($project_id) ? 'disabled' : '' }}>
                    @if (isset($project_id))
                        <option value="{{ $project_id }}" selected>
                            {{ $projects->where('id', $project_id)->first()->name }}
                    @else
                        <option value="" disabled selected>Selecione um projeto</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}
                            </option>
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
                <label for="type_trip_id" class="block text-sm font-medium text-gray-700">Tipo de viagem</label>
                <select name="type_trip_id"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('type_trip_id') border-red-500 @enderror"
                    required>
                    <option value="" disabled selected>Selecione um tipo de viagem</option>
                    @foreach ($typeTrips as $typeTrip)
                        <option value="{{ $typeTrip->id }}"
                            {{ old('type_trip_id') == $typeTrip->id ? 'selected' : '' }}>{{ $typeTrip->type }}
                        </option>
                    @endforeach
                </select>
                @error('type_trip_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="search_vehicle" class="block text-sm font-medium text-gray-700">Pesquisar veículo por
                    matrícula</label>
                <input type="text" name="search_vehicle" id="search_vehicle"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    value="{{ old('search_vehicle') }}">
            </div>
            <div class="form-group">
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Veículo</label>
                <select name="vehicle_id" id="vehicle_id"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('vehicle_id') border-red-500 @enderror">
                    <option value="" disabled selected>Selecione um veículo</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate }}</option>
                    @endforeach
                </select>
                <div id="vehicle-error" class="text-red-500">{{ session('vehicle_error') }}</div>
                @error('vehicle_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" id="submit-button"
                    class="w-full py-2 text-white bg-gray-600 hover:bg-gray-700 rounded-md transition-colors duration-200">
                    Criar
                </button>
            </div>
        </form>
    </div>
</div>

<script>

    function disableSubmitButton(event) {
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = true;
            submitButton.innerText = 'Aguarde...';
        }

</script>

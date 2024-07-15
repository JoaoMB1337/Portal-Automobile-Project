<div id="trip-modal" class="fixed inset-0 z-50 hidden overflow-y-auto lg:pl-64">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <button type="button" class="absolute top-0 right-0 p-2 m-2 text-gray-400 hover:text-gray-500 close-modal" data-modal="trip-modal">
                    <span class="sr-only">Fechar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title"> Criar uma Viagem </h3>
                    </div>
                </div>
                <div class="w-full rounded-xl p-7 custom-card mt-6">
                    <form method="POST" action="{{ route('trips.store') }}">
                        @csrf
                        <!-- Campos do formulário aqui -->
                        <div class="form-group">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                            <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required value="{{ old('start_date') }}">
                            @error('start_date')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Fim</label>
                            <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('end_date') border-red-500 @enderror" required value="{{ old('end_date') }}">
                            @error('end_date')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                            <input type="text" name="destination" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('destination') border-red-500 @enderror" required value="{{ old('destination') }}">
                            @error('destination')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="purpose" class="block text-sm font-medium text-gray-700">Propósito da Viagem</label>
                            <textarea name="purpose" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('purpose') border-red-500 @enderror" required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="employee_name" class="block text-sm font-medium text-gray-700">Pesquisar Funcionário</label>
                            <input type="text" name="employee_name" id="employee_name" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('employee_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="employee_id" class="block text-sm font-medium text-gray-700">Funcionário</label>
                            <select name="employee_id" id="employee_id" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('employee_id') border-red-500 @enderror" required>
                                <option value="" disabled selected>Selecione um funcionário</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <div id="employee-error" class="text-red-500">{{ session('employee_error') }}</div>
                            @error('employee_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="project_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                            <select name="project_id" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('project_id') border-red-500 @enderror" required {{ old('project_id') ? 'disabled' : '' }}>
                                <option value="" disabled selected>Selecione um projeto</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type_trip_id" class="block text-sm font-medium text-gray-700">Tipo de Viagem</label>
                            <select name="type_trip_id" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('type_trip_id') border-red-500 @enderror" required>
                                <option value="" disabled selected>Selecione um tipo de viagem</option>
                                @foreach ($typeTrips as $typeTrip)
                                    <option value="{{ $typeTrip->id }}" {{ old('type_trip_id') == $typeTrip->id ? 'selected' : '' }}>{{ $typeTrip->type }}</option>
                                @endforeach
                            </select>
                            @error('type_trip_id')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="search_vehicle" class="block text-sm font-medium text-gray-700">Pesquisar Veículo por Matrícula</label>
                            <input type="text" name="search_vehicle" id="search_vehicle" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('search_vehicle') }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Veículo</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('vehicle_id') border-red-500 @enderror" {{ old('vehicle_id') ? 'disabled' : '' }}>
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
                            <button type="submit" id="submit-button" class="w-full py-2 text-white bg-gray-600 hover:bg-gray-700 rounded-md transition-colors duration-200"> Criar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

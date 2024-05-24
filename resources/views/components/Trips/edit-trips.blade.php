<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Editar Viagem</h3>
            <form action="{{ url('trips/' . $trip->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Data de Início</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $trip->start_date }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Data de Fim</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $trip->end_date }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>


                    <div class="col-span-2">
                        <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                        <input type="text" name="destination" id="destination" value="{{ $trip->destination }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="purpose" class="block text-sm font-medium text-gray-700">Propósito</label>
                        <textarea name="purpose" id="purpose" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>{{ $trip->purpose }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="employee_id" class="block text-sm font-medium text-gray-700">Funcionário</label>
                        <select name="employee_id" id="employee_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $trip->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="project_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                        <select name="project_id" id="project_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $trip->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-span-2">
                        <label for="type_trip_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                        <select name="type_trip_id" id="project_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($typeTrips as $typeTrip)
                                <option value="{{ $project->id }}" {{ $trip->type_trip_id == $typeTrip->id ? 'selected' : '' }}>{{ $typeTrip->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Veiculo</label>
                        <select name="vehicle_id" id="vehicle_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->plate }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-span-2">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Atualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

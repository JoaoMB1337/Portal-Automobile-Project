
    <div class="flex">
        <div class="w-3/4 mx-auto">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Editar Projeto</h3>
                <form action="{{ url('projects/' . $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" value="{{ $project->name }}"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="address" id="address" value="{{ $project->address }}"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="col-span-2">
                            <label for="projectstatus" class="block text-sm font-medium text-gray-700">Status do
                                Projeto</label>
                            <select id="projectstatus" name="projectstatus"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @foreach ($projectstatuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $project->project_status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->status_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="district" class="block text-sm font-medium text-gray-700">Distrito</label>
                            <select id="district" name="district"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $project->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="country" class="block text-sm font-medium text-gray-700">País</label>
                            <select id="country" name="country"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $project->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Salvar
                        </button>
                        <a href="{{ url('projects') }}"
                            class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

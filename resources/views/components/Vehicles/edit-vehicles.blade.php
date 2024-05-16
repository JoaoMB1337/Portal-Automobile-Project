<div class="flex">
    <!-- Conteúdo principal -->
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Editar Veículo</h3>
            <form action="{{ url('vehicles/' . $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2">
                        <label for="plate" class="block text-sm font-medium text-gray-700">Matrícula</label>
                        <input type="text" name="plate" id="plate" value="{{ $vehicle->plate }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="km" class="block text-sm font-medium text-gray-700">Quilometragem</label>
                        <input type="number" name="km" id="km" value="{{ $vehicle->km }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condição</label>
                        <input type="text" name="condition" id="condition" value="{{ $vehicle->condition }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="brand_id" class="block text-sm font-medium text-gray-700">Marca</label>
                        <select id="brand_id" name="brand_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $vehicle->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="car_category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select id="car_category_id" name="car_category_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @foreach($carCategories as $carCategory)
                                <option value="{{ $carCategory->id }}" {{ $vehicle->car_category_id == $carCategory->id ? 'selected' : '' }}>{{ $carCategory->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="fuel_type_id" class="block text-sm font-medium text-gray-700">Tipo de Combustível</label>
                        <select id="fuel_type_id" name="fuel_type_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @foreach($fuelTypes as $fuelType)
                                <option value="{{ $fuelType->id }}" {{ $vehicle->fuel_type_id == $fuelType->id ? 'selected' : '' }}>{{ $fuelType->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Adicione os campos restantes para edição de veículos aqui -->

                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Salvar
                    </button>
                    <a href="{{ url('vehicles') }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

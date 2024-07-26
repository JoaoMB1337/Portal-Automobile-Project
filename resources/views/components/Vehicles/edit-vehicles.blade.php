<div class="container py-8 px-4 sm:px-6 lg:px-8">
    <div class="w-full sm:w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                @include('components.ButtonComponents.backButton')

                <div class="flex-grow text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Editar veículo</h3>
                </div>
                <div class="w-10 h-10"></div>
            </div>
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="plate" class="block text-sm font-medium text-gray-700">Placa</label>
                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            id="plate" name="plate" value="{{ $vehicle->plate }}" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="km" class="block text-sm font-medium text-gray-700">KM</label>
                        <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            id="km" name="km" value="{{ $vehicle->km }}" required>
                    </div>
                    <div class="col-span-2">
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condição</label>
                        <select
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="condition" name="condition" required>
                            @foreach ($vehicleCondition as $condition)
                                <option value="{{ $condition->id }}"
                                    {{ $vehicle->vehicle_condition_id == $condition->id ? 'selected' : '' }}>
                                    {{ $condition->condition }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="brand" class="block text-sm font-medium text-gray-700">Marca</label>
                        <select
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="brand" name="brand" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $vehicle->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="fuel_type_id" class="block text-sm font-medium text-gray-700">Tipo de
                            combustível</label>
                        <select
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="fuel_type_id" name="fuel_type_id" required>
                            @foreach ($fuelTypes as $fuelType)
                                <option value="{{ $fuelType->id }}"
                                    {{ $vehicle->fuel_type_id == $fuelType->id ? 'selected' : '' }}>
                                    {{ $fuelType->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="car_category_id" class="block text-sm font-medium text-gray-700">Categoria do
                            carro</label>
                        <select
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="car_category_id" name="car_category_id" required>
                            @foreach ($carCategories as $carCategory)
                                <option value="{{ $carCategory->id }}"
                                    {{ $vehicle->car_category_id == $carCategory->id ? 'selected' : '' }}>
                                    {{ $carCategory->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="passenger_quantity" class="block text-sm font-medium text-gray-700">Numero de
                            passageiros</label>
                        <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            id="passenger_quantity" name="passenger_quantity"
                            value="{{ $vehicle->passenger_quantity }}" required>
                    </div>

                    @if ($vehicle->is_external)
                        <div id="externalVehicleFields" class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Detalhes do aluguer</label>
                            <div class="border rounded-md p-4">
                                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="contract_number"
                                            class="block text-sm font-medium text-gray-700">Número do contrato</label>
                                        <input type="text"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="contract_number" name="contract_number"
                                            value="{{ $vehicle->contract_number }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_price_per_day"
                                            class="block text-sm font-medium text-gray-700">Preço do aluguer por
                                            dia</label>
                                        <input type="number"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_price_per_day" name="rental_price_per_day"
                                            value="{{ $vehicle->rental_price_per_day }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_start_date"
                                            class="block text-sm font-medium text-gray-700">Data de início do
                                            aluguer</label>
                                        <input type="date"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_start_date" name="rental_start_date"
                                            value="{{ $vehicle->rental_start_date }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_end_date"
                                            class="block text-sm font-medium text-gray-700">Data de fim do
                                            aluguer</label>
                                        <input type="date"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_end_date" name="rental_end_date"
                                            value="{{ $vehicle->rental_end_date }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_company"
                                            class="block text-sm font-medium text-gray-700">Empresa de aluguer</label>
                                        <input type="text"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_company" name="rental_company"
                                            value="{{ $vehicle->rental_company }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_contact_person"
                                            class="block text-sm font-medium text-gray-700">Pessoa de contato do
                                            aluguer</label>
                                        <input type="text"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_contact_person" name="rental_contact_person"
                                            value="{{ $vehicle->rental_contact_person }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_contact_number"
                                            class="block text-sm font-medium text-gray-700">Número de contato do
                                            aluguer</label>
                                        <input type="text"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="rental_contact_number" name="rental_contact_number"
                                            value="{{ $vehicle->rental_contact_number }}">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="pdf_file" class="block text-sm font-medium text-gray-700">PDF do
                                            contrato</label>
                                        <input type="file"
                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            id="pdf_file" name="pdf_file">
                                        @if ($vehicle->pdf_file)
                                            <div class="mt-2 flex items-center">
                                                <p class="text-sm text-gray-700">PDF atual:</p>
                                                <a href="{{ route('vehicles.downloadPdf', $vehicle->id) }}"
                                                    class="ml-2 px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded">Download</a>
                                                <input type="hidden" name="current_pdf"
                                                    value="{{ $vehicle->pdf_file }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        Atualizar
                    </button>
                    <a href="{{ url('vehicles') }}"
                        class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @media (max-width: 640px) {
        .flex-col {
            flex-direction: column;
        }

        .w-full {
            width: 100%;
        }

        .mt-10 {
            margin-top: 2.5rem;
        }

        .sm\:col-span-2 {
            grid-column: span 2 / span 2;
        }
    }
</style>

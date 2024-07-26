@vite('resources/js/Vehicles/vehicles-create.js')

<div class="w-full rounded-xl p-7 custom-card mt-12">
    @include('components.ButtonComponents.backButton')

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Criar veículo</h1>
        <p class="text-gray-600">Preencha os campos abaixo para criar um novo veículo.</p>
    </div>

    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="plate" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
            <input id="plate" type="text" maxlength="20"
                class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('plate') border-red-500 @enderror"
                name="plate" value="{{ old('plate') }}" required autocomplete="plate" autofocus>
            @error('plate')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @else
                <p class="text-gray-500 text-xs mt-1">A matrícula deve ser única.</p>
            @enderror
        </div>

        <div>
            <label for="km" class="block text-sm font-semibold text-gray-700 mb-2">Quilometragem</label>
            <input id="km" type="number" max="9999999"
                class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('km') border-red-500 @enderror"
                name="km" value="{{ old('km') }}" required autocomplete="km">
            @error('km')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="condition" class="block text-sm font-semibold text-gray-700 mb-2">Condição</label>
            <select id="condition" name="condition"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('condition') border-red-500 @enderror"
                required>
                <option value="" disabled selected>Selecione a condição</option>
                @foreach ($vehicleCondition as $condition)
                    <option value="{{ $condition->id }}" @if (old('condition') == $condition->id) selected @endif>
                        {{ $condition->condition }}</option>
                @endforeach
            </select>
            @error('condition')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="brand" class="block text-sm font-semibold text-gray-700 mb-2">Marca</label>
            <select id="brand" name="brand"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('brand') border-red-500 @enderror"
                required autocomplete="brand" autofocus>
                <option value="" disabled selected>Selecione a marca</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @if (old('brand') == $brand->id) selected @endif>
                        {{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="passenger_quantity" class="block text-sm font-semibold text-gray-700 mb-2">Número de
                passageiros</label>
            <input id="passengers" type="number" max="170"
                class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('passengers') border-red-500 @enderror"
                name="passengers" value="{{ old('passengers') }}" required autocomplete="passengers">
            @error('passengers')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for=" carCategory" class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
            <select id=" carCategory" name=" carCategory"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error(' carCategory') border-red-500 @enderror"
                required autocomplete=" carCategory" autofocus>
                <option value="" disabled selected>Selecione a categoria</option>
                @foreach ($carCategories as $carCategory)
                    <option value="{{ $carCategory->id }}" @if (old(' carCategory') == $carCategory->id) selected @endif>
                        {{ $carCategory->category }}</option>
                @endforeach
            </select>
            @error(' carCategory')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fuelTypes" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de combustível</label>
            <select id="fuelTypes" name="fuelTypes"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('fuelTypes') border-red-500 @enderror"
                required autocomplete="fuelTypes" autofocus>
                <option value="" disabled selected>Selecione o tipo de combustível</option>
                @foreach ($fuelTypes as $fuelType)
                    <option value="{{ $fuelType->id }}" @if (old('type_fuel') == $fuelType->id) selected @endif>
                        {{ $fuelType->type }}</option>
                @endforeach
            </select>
            @error('fuelTypes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notas</label>
            <textarea id="notes"
                class="form-textarea w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('notes') border-red-500 @enderror"
                name="notes" autocomplete="notes" rows="4">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="is_external" class="block text-sm font-semibold text-gray-700 mb-2">É externo?</label>
            <input id="is_external" type="checkbox" class="form-checkbox" name="is_external" value="1"
                @if (old('is_external')) checked @endif>
            @error('is_external')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="external-field" style="display: none;">
            <div class="mb-5">
                <label for="contract_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de
                    contrato</label>
                <input id="contract_number" type="text" maxlength="20"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('contract_number') border-red-500 @enderror"
                    name="contract_number" value="{{ old('contract_number') }}">
                @error('contract_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="rental_price_per_day" class="block text-sm font-semibold text-gray-700 mb-2">Preço de
                    aluger por dia</label>
                <input id="rental_price_per_day" type="text"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_price_per_day') border-red-500 @enderror"
                    name="rental_price_per_day" value="{{ old('rental_price_per_day') }}"
                    autocomplete="rental_price_per_day">
                @error('rental_price_per_day')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="rental_start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de início
                    do aluguer</label>
                <input id="rental_start_date" type="date"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_start_date') border-red-500 @enderror"
                    name="rental_start_date" value="{{ old('rental_start_date') }}">
                @error('rental_start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="rental_end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de fim do
                    aluguer</label>
                <input id="rental_end_date" type="date"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_end_date') border-red-500 @enderror"
                    name="rental_end_date" value="{{ old('rental_end_date') }}">
                @error('rental_end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="rental_company" class="block text-sm font-semibold text-gray-700 mb-2">Empresa de
                    rentCar</label>
                <input id="rental_company" type="text"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_company') border-red-500 @enderror"
                    name="rental_company" value="{{ old('rental_company') }}" autocomplete="rental_company">
                @error('rental_company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="rental_contact_person" class="block text-sm font-semibold text-gray-700 mb-2">Pessoa de
                    contato do rentCar</label>
                <input id="rental_contact_person" type="text"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_contact_person') border-red-500 @enderror"
                    name="rental_contact_person" value="{{ old('rental_contact_person') }}"
                    autocomplete="rental_contact_person">
                @error('rental_contact_person')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="rental_contact_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de
                    contato do rentCar</label>
                <input id="rental_contact_number" type="text"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_contact_number') border-red-500 @enderror"
                    name="rental_contact_number" value="{{ old('rental_contact_number') }}"
                    autocomplete="rental_contact_number">
                @error('rental_contact_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="pdf_file" class="block text-sm font-semibold text-gray-700 mb-2">PDF</label>
                <input id="pdf_file" type="file"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('pdf_file') border-red-500 @enderror"
                    name="pdf_file">
                @error('pdf_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="pt-6">
            <button type="submit"
                class="w-full py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2  custom-btn">Criar</button>
        </div>
    </form>
</div>

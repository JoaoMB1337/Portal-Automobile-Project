<div class="w-full rounded-xl p-7 custom-card mt-12">
    @include('components.ButtonComponents.backButton')

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Criar projeto</h1>
            <p class="text-gray-600">Preencha os campos abaixo para criar um novo projeto.</p>
        </div>

    <form method="POST" action="{{ route('projects.store') }}" 
        class="space-y-6" onsubmit="disableSubmitButton(event)">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome do projeto</label>
            <input id="name" type="text"
                class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Endereço do projeto</label>
            <input id="address" type="text"
                class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror"
                name="address" value="{{ old('address') }}" required autocomplete="address">
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="projectstatus" class="block text-sm font-semibold text-gray-700 mb-2">Status do projeto</label>
            <select id="projectstatus" name="projectstatus"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('projectstatus') border-red-500 @enderror"
                required autocomplete="projectstatus" autofocus>
                <option value="" selected>Selecione o status</option>
                @foreach ($projectstatuses as $status)
                    <option value="{{ $status->id }}" @if (old('projectstatus') == $status->id) selected @endif>
                        {{ $status->status_name }}</option>
                @endforeach
            </select>
            @error('projectstatus')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">País</label>
            <select id="country" name="country"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('country') border-red-500 @enderror"
                required autocomplete="country" autofocus>
                <option value="" selected>Selecione o país</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if (old('country') == $country->id) selected @endif>
                        {{ $country->name }}</option>
                @endforeach
            </select>
            @error('country')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="district" class="block text-sm font-semibold text-gray-700 mb-2">Distrito</label>
            <select id="district" name="district"
                class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('district') border-red-500 @enderror"
                autocomplete="district" autofocus>
                <option value="" selected>Selecione o distrito</option>
            </select>
            @error('district')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" id="submit-button" class="custom-btn w-full py-2 rounded-md">
                Criar
            </button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const districts = @json($districts);
        const countrySelect = document.getElementById('country');
        const districtSelect = document.getElementById('district');

        function updateDistricts() {
            const selectedCountry = countrySelect.value;
            const districtOptions = districts[selectedCountry] || [];

            districtSelect.innerHTML = '<option value="" selected>Selecione o Distrito</option>';
            districtOptions.forEach(district => {
                const option = document.createElement('option');
                option.value = district.id;
                option.textContent = district.name;
                districtSelect.appendChild(option);
            });
        }

        countrySelect.addEventListener('change', updateDistricts);
        updateDistricts();
    });
    function disableSubmitButton(event) {
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = true;
            submitButton.innerText = 'Aguarde...';
        }
</script>

<div id="project-modal" class="fixed inset-0 z-50 hidden overflow-y-auto lg:pl-64">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <button type="button" class="absolute top-0 right-0 p-2 m-2 text-gray-400 hover:text-gray-500 close-modal" data-modal="project-modal">
                    <span class="sr-only">Fechar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Criar um Projeto
                        </h3>
                    </div>
                </div>
                <div class="w-full rounded-xl p-7 custom-card mt-6">
                    <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome do Projeto</label>
                            <input id="name" type="text"
                                   class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Endereço do Projeto</label>
                            <input id="address" type="text"
                                   class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror"
                                   name="address" value="{{ old('address') }}" required autocomplete="address">
                            @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="projectstatus" class="block text-sm font-semibold text-gray-700 mb-2">Status do Projeto</label>
                            <select id="projectstatus" name="projectstatus"
                                    class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('projectstatus') border-red-500 @enderror"
                                    required autocomplete="projectstatus" autofocus>
                                <option value="" selected>Selecione o Status</option>
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
                                <option value="" selected>Selecione o País</option>
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
                                <option value="" selected>Selecione o Distrito</option>
                            </select>
                            @error('district')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button id="next-create-vehicle" type="button" class="custom-btn w-full py-2 rounded-md mt-4">
                                Próximo: Criar Veículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</script>

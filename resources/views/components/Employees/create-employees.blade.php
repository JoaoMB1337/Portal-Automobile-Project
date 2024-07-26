@vite('resources/js/Geral/create.js')

<div class="w-full rounded-xl p-7 custom-card mt-12">
    <div class="text-center flex-grow mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Registo de funcionário</h1>
        <p class="text-gray-600">Preencha os campos abaixo para registar um novo funcionário.</p>
    </div>
    <form method="POST" action="{{ route('employees.store') }}"  onsubmit="disableSubmitButton(event)" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome</label>
            <div class="flex">
                <i class="fas fa-user icon"></i>
                <input id="name" type="text"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="employee_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de
                funcionário</label>
            <div class="flex">
                <i class="fas fa-id-badge icon"></i>
                <input id="employee_number" type="text"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_number') border-red-500 @enderror"
                    name="employee_number" value="{{ old('employee_number') }}" required>
            </div>
            @error('employee_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Género</label>
            <div class="flex">
                <i class="fas fa-venus-mars icon"></i>
                <select id="gender"
                    class="form-control w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('gender') border-red-500 @enderror"
                    name="gender" required>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculino</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Feminino</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>
            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de nascimento</label>
            <div class="flex">
                <i class="fas fa-calendar-alt icon"></i>
                <input id="birth_date" type="date"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('birth_date') border-red-500 @enderror"
                    name="birth_date" value="{{ old('birth_date') }}" required>
            </div>
            @error('birth_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="CC" class="block text-sm font-semibold text-gray-700 mb-2">Número de cartão de
                cidadão</label>
            <div class="flex">
                <i class="fas fa-id-card icon"></i>
                <input id="CC" type="text"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('CC') border-red-500 @enderror"
                    name="CC" value="{{ old('CC') }}" required>
            </div>
            @error('CC')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="NIF" class="block text-sm font-semibold text-gray-700 mb-2">Número de identificação fiscal
            </label>
            <div class="flex">
                <i class="fas fa-id-card icon"></i>
                <input id="NIF" type="text"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('NIF') border-red-500 @enderror"
                    name="NIF" value="{{ old('NIF') }}" required>
            </div>
            @error('NIF')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Morada</label>
            <div class="flex">
                <i class="fas fa-home icon"></i>
                <input id="address" type="text"
                    class="form-input w-full rounded-md  focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror"
                    name="address" value="{{ old('address') }}">
            </div>
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="employee_role_id" class="block text-sm font-semibold text-gray-700 mb-2">Função do
                funcionário</label>
            <div class="flex">
                <i class="fas fa-briefcase icon"></i>
                <select id="employee_role_id"
                    class="form-control w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('employee_role_id') border-red-500 @enderror"
                    name="employee_role_id" required>
                    @foreach ($roles as $role)
                        @if ($role->name !== 'Administrador' || Auth::user()->role->name === 'Administrador')
                            <option value="{{ $role->id }}"
                                {{ old('employee_role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            @error('employee_role_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address Field -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <div class="flex">
                <i class="fas fa-envelope icon"></i>
                <input id="email" type="email"
                    class="form-input w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('email') border-red-500 @enderror"
                    name="email" value="{{ old('email') }}">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Number Field -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Número de telemóvel</label>
            <div class="flex">
                <i class="fas fa-phone icon"></i>
                <input id="phone" type="text"
                    class="form-input w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('phone') border-red-500 @enderror"
                    name="phone" value="{{ old('phone') }}">
            </div>
            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contacts" class="block text-sm font-semibold text-gray-700 mb-2">Contactos</label>
            <div id="contacts-container">
                <div class="flex mb-2">
                    <select name="contacts[0][type]" class="form-select mr-2">
                        @foreach ($contactTypes as $contactType)
                            <option value="{{ $contactType->id }}">{{ $contactType->type }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="contacts[0][value]"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200">
                </div>
                <div class="w-10 h-10"></div> <!-- Adicionei esta div para ocupar espaço simétrico -->
            </div>
            <button type="button" id="add-contact-btn"
                class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn">Adicionar
                contacto</button>
        </div>


        <div>
            <label for="driving_licenses" class="block text-sm font-semibold text-gray-700 mb-2">Carta de
                condução</label>
            <div class="flex flex-wrap gap-4">
                @foreach ($drivingLicenses as $license)
                    <div class="flex items-center">
                        <input id="license{{ $license->id }}" type="checkbox"
                            class="form-checkbox h-5 w-5 text-gray-600" name="driving_licenses[]"
                            value="{{ $license->id }}"
                            {{ in_array($license->id, old('driving_licenses', [])) ? 'checked' : '' }}>
                        <label for="license{{ $license->id }}"
                            class="ml-2 text-gray-700">{{ $license->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('driving_licenses')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <div class="flex">
                <i class="fas fa-lock icon"></i>
                <input id="password" type="password"
                    class="form-input w-full rounded-md focus:border-gray-400 focus:ring focus:ring-gray-200 @error('password') border-red-500 @enderror"
                    name="password" required autocomplete="new-password">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password-confirm" class="block text-sm font-semibold text-gray-700 mb-2">Confirmação de
                password</label>
            <div class="flex">
                <i class="fas fa-lock icon"></i>
                <input id="password-confirm" type="password"
                    class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200"
                    name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" id ="submit-button"
                class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                {{ __('Registar') }}
            </button>
        </div>
    </form>
</div>

<script>
    window.contactTypes = @json($contactTypes);


    function disableSubmitButton(event) {
        const submitButton = document.getElementById('submit-button');
        submitButton.disabled = true;
        submitButton.innerText = 'Aguarde...';
    }
</script>

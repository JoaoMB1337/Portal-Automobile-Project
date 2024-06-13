@vite('resources/js/Employees/employees-edit.js')
<div class="container py-8 px-4 sm:px-6 lg:px-8">
    <div class="w-full sm:w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('employees.index') }}" class="flex items-center justify-center w-10 h-10 mb-3">
                    <button type="button" class="flex items-center justify-center w-full h-full text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                        <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </button>
                </a>
                <div class="flex-grow text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Editar Funcionário</h3>
                </div>
                <div class="w-10 h-10"></div> <!-- Adicionei esta div para ocupar espaço simétrico -->
            </div>
            <form action="{{ url('employees/' . $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="name" value="{{ $employee->name }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="employee_number" class="block text-sm font-medium text-gray-700">Nr Funcionário</label>
                        <input type="text" name="employee_number" id="employee_number" value="{{ $employee->employee_number }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('employee_number') border-red-500 @enderror" required>
                        @error('employee_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $employee->email }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gênero</label>
                        <select id="gender" name="gender" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('gender') border-red-500 @enderror" required>
                            <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Masculino</option>
                            <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Feminino</option>
                            <option value="other" {{ $employee->gender === 'other' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('gender')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ $employee->birth_date }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('birth_date') border-red-500 @enderror" required>
                        @error('birth_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror" required>
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="CC" class="block text-sm font-medium text-gray-700">CC</label>
                        <input type="text" name="CC" id="CC" value="{{ $employee->CC }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('CC') border-red-500 @enderror" required>
                        @error('CC')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="NIF" class="block text-sm font-medium text-gray-700">NIF</label>
                        <input type="text" name="NIF" id="NIF" value="{{ $employee->NIF }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('NIF') border-red-500 @enderror" required>
                        @error('NIF')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="address" id="address" value="{{ $employee->address }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror" required>
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="employee_role_id" class="block text-sm font-medium text-gray-700">Cargo</label>
                        <select id="employee_role_id" name="employee_role_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('employee_role_id') border-red-500 @enderror" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $employee->employee_role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('employee_role_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="contacts" class="block text-sm font-medium text-gray-700">Contatos</label>
                        <div id="contacts-container">
                            @foreach($employee->contacts as $index => $contact)
                                <div class="flex mb-2">
                                    <select name="contacts[{{ $index }}][type]" class="form-select mr-2 @error("contacts.{$index}.type") border-red-500 @enderror">
                                        @foreach($contactTypes as $contactType)
                                            <option value="{{ $contactType->id }}" {{ $contact->contact_type_id == $contactType->id ? 'selected' : '' }}>{{ $contactType->type }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="contacts[{{ $index }}][value]" value="{{ $contact->contact_value }}" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error("contacts.{$index}.value") border-red-500 @enderror">
                                    <button type="button" class="ml-2 text-red-600 remove-contact-btn">&times;</button>
                                    @error("contacts.{$index}.type")
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @error("contacts.{$index}.value")
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-contact-btn" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full custom-btn">Adicionar Contato</button>
                    </div>

                    <div class="col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha (opcional)</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password') border-red-500 @enderror">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password_confirmation') border-red-500 @enderror">
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="driving_licenses" class="block text-sm font-medium text-gray-700">Cartas de Condução</label>
                        <div class="mt-2 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-4">
                            @foreach($drivingLicenses as $license)
                                <div class="flex items-center">
                                    <input id="license{{ $license->id }}" type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 @error('driving_licenses') border-red-500 @enderror" name="driving_licenses[]" value="{{ $license->id }}" {{ in_array($license->id, $employee->drivingLicenses->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label for="license{{ $license->id }}" class="ml-2 text-sm text-gray-700">{{ $license->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('driving_licenses')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-center sm:justify-start">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Salvar
                    </button>
                    <a href="{{ url('employees') }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.contactTypes = @json($contactTypes);
</script>

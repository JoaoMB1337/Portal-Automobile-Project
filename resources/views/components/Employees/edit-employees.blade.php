@vite('resources/js/Geral/edit.js')

<div class="container py-8 px-4 sm:px-6 lg:px-8">
    <div class="w-full sm:w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                @include('components.ButtonComponents.backButton')
                <div class="flex-grow text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Editar funcionário</h3>
                </div>
                <div class="w-10 h-10"></div>
            </div>
            <form action="{{ url('employees/' . $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="name" value="{{ $employee->name }}"
                            class="mt-1 block w-full shadow-sm  @error('name')  @enderror" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="employee_number" class="block text-sm font-medium text-gray-700">Nr
                            funcionário</label>
                        <input type="text" name="employee_number" id="employee_number"
                            value="{{ $employee->employee_number }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('employee_number') border-red-500 @enderror"
                            required>
                        @error('employee_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $employee->email }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gênero</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('gender') border-red-500 @enderror"
                            required>
                            <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Feminino
                            </option>
                            <option value="other" {{ $employee->gender === 'other' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Data de
                            nascimento</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ $employee->birth_date }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('birth_date') border-red-500 @enderror"
                            required>
                        @error('birth_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="phone" id="phone" value="{{ $employee->phone }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone') border-red-500 @enderror"
                            required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="CC" class="block text-sm font-medium text-gray-700">CC</label>
                        <input type="text" name="CC" id="CC" value="{{ $employee->CC }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('CC') border-red-500 @enderror"
                            required>
                        @error('CC')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="NIF" class="block text-sm font-medium text-gray-700">NIF</label>
                        <input type="text" name="NIF" id="NIF" value="{{ $employee->NIF }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('NIF') border-red-500 @enderror"
                            required>
                        @error('NIF')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="address" id="address" value="{{ $employee->address }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror"
                            required>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="employee_role_id" class="block text-sm font-medium text-gray-700">Cargo</label>
                        <select id="employee_role_id" name="employee_role_id"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('employee_role_id') border-red-500 @enderror"
                            required>
                            @foreach ($roles as $role)
                                @if ($role->name !== 'Administrador' || Auth::user()->role->name === 'Administrador')
                                    <option value="{{ $role->id }}"
                                        {{ $employee->employee_role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('employee_role_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="employee_role_id" class="block text-sm font-medium text-gray-700">Alterar
                            password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="employee_role_id" class="block text-sm font-medium text-gray-700">Confirmar
                            password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password_confirmation') border-red-500 @enderror">
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                    <div class="col-span-2">
                        <label for="contacts" class="block text-sm font-medium text-gray-700">Contatos</label>
                        <div id="contacts-container">
                            @foreach ($employee->contacts as $index => $contact)
                                <div class="flex mb-2">
                                    <select name="contacts[{{ $index }}][type]"
                                        class="form-select mr-2 @error("contacts.{$index}.type") border-red-500 @enderror">
                                        @foreach ($contactTypes as $contactType)
                                            <option value="{{ $contactType->id }}"
                                                {{ $contact->contact_type_id == $contactType->id ? 'selected' : '' }}>
                                                {{ $contactType->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="contacts[{{ $index }}][value]"
                                        value="{{ $contact->contact_value }}"
                                        class="form-input flex-1 @error("contacts.{$index}.value") border-red-500 @enderror">
                                    @error("contacts.{$index}.value")
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-contact"
                            class="mt-2 px-4 py-2 bg-gray-600 border -lg gap-x-2 hover:bg-gray-500 text-white rounded-md">Adicionar
                            contato</button>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm bg-gray-600  rounded-lg gap-x-2 hover:bg-gray-500 text-white">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.contactTypes = @json($contactTypes);
</script>

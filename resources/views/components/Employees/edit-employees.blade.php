<div class="flex">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Editar Funcionário</h3>
            <form action="{{ url('employees/' . $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" id="name" value="{{ $employee->name }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $employee->email }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gênero</label>
                        <select id="gender" name="gender" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            <option value="male" {{ $employee->gender === 'male' ? 'selected' : '' }}>Masculino</option>
                            <option value="female" {{ $employee->gender === 'female' ? 'selected' : '' }}>Feminino</option>
                            <option value="other" {{ $employee->gender === 'other' ? 'selected' : '' }}>Outro</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ $employee->birth_date }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="CC" class="block text-sm font-medium text-gray-700">CC</label>
                        <input type="text" name="CC" id="CC" value="{{ $employee->CC }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="NIF" class="block text-sm font-medium text-gray-700">NIF</label>
                        <input type="text" name="NIF" id="NIF" value="{{ $employee->NIF }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="address" id="address" value="{{ $employee->address }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="col-span-2">
                        <label for="employee_role_id" class="block text-sm font-medium text-gray-700">Cargo</label>
                        <select id="employee_role_id" name="employee_role_id" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $employee->employee_role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-2">
                        <label for="driving_licenses" class="block text-sm font-medium text-gray-700">Cartas de Condução</label>
                        <div class="mt-2 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-4">
                            @foreach($drivingLicenses as $license)
                                <div class="flex items-center">
                                    <input id="license{{ $license->id }}" type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" name="driving_licenses[]" value="{{ $license->id }}" {{ in_array($license->id, $employee->drivingLicenses->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label for="license{{ $license->id }}" class="ml-2 text-sm text-gray-700">{{ $license->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="mt-6">
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
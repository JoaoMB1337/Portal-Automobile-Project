<div class="container py-8">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('employees.index') }}">
                    <button type="button" class="flex items-center justify-center w-1/2 mb-3 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 sm:w-auto hover:bg-gray-500">
                        <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </button>
                </a>
                <div class="text-center flex-grow mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes Principais</h3>
                </div>
            </div>
            <p class="max-w-2xl text-sm text-gray-500">Detalhes pessoais e informações de contato</p>
            <div class="border-t border-gray-200">

                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nome</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Número de Funcionário</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->employee_number }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->email }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->phone }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Cargo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->role->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de nascimento</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->birth_date }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Endereço</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->address }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NIF</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->NIF }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">CC</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $employee->CC }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 my-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Cartas de Condução</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($employee->drivingLicenses->isEmpty())
                                Nenhuma
                            @else
                                <ul>
                                    @foreach($employee->drivingLicenses as $license)
                                        <li>{{ $license->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-center py-4">
                        <a href="{{ route('employees.exportCsv', ['id' => $employee->id]) }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            Exportar CSV
                        </a>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>

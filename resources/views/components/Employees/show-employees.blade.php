@vite(['resources/css/Trips/trip-show.css'])
<div class="container py-8 px-4 ">
    <div class="w-full  ">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            @if (Auth::check() && Auth::user()->isMaster())
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-4">
                    @include('components.ButtonComponents.backButton')
                    <div class="flex-grow text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Detalhes principais</h3>
                        <p class="max-w-2xl text-sm text-gray-500">Detalhes pessoais e informações de contato</p>
                    </div>
                    <div class="w-10 h-10"></div> <!-- Espaço vazio para alinhar o título ao centro -->
                </div>
            @endif
            <div class="border-t border-gray-200">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nome</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Número de Funcionário</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->employee_number }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->email }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->phone }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Cargo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->role->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Data de nascimento</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->birth_date }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Endereço</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->address }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NIF</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->NIF }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">CC</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $employee->CC }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Cartas de condução</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($employee->drivingLicenses->isEmpty())
                                Nenhuma
                            @else
                                <ul>
                                    @foreach ($employee->drivingLicenses as $license)
                                        <li>{{ $license->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Outros contactos</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul>
                                @if ($employee->contacts->isNotEmpty())
                                    @foreach ($employee->contacts as $contact)
                                        <li>{{ $contact->contactType->type }}: {{ $contact->contact_value }}</li>
                                    @endforeach
                                @else
                                    <li>Nenhum contato disponível.</li>
                                @endif
                            </ul>
                        </dd>
                    </div>
                </dl>
                @if (Auth::check() && Auth::user()->isMaster())
                <div class="flex flex-col sm:flex-row justify-center py-5 gap-2 pt-10">
                    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}"
                        class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded transition duration-300 ease-in-out w-full sm:w-32 h-12 text-center">
                        Editar
                    </a>

                    <button id="openModalBtn"
                        class="bg-red-800 hover:bg-red-700 text-white font-bold py-3 px-4 rounded transition duration-300 ease-in-out w-full sm:w-32 h-12 text-center">
                        Eliminar
                    </button>

                    <a href="{{ route('employees.exportCsv', ['id' => $employee->id]) }}"
                        class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded transition duration-300 ease-in-out w-full sm:w-32 h-12 text-center">
                        Exportar CSV
                    </a>

                    <button id="openReset2FAModalBtn"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-bold py-3 px-4 rounded transition duration-300 ease-in-out w-full sm:w-32 h-12 text-center"
                        data-action="{{ route('employees.reset2fa', $employee->id) }}">
                        Resetar 2FA
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('components.Modals.modal-delete-single')
@include('components.Modals.modal-confirm-reset-2fa')

<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
    }

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

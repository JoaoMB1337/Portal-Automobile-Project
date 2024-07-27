@vite(['resources/js/Geral/list.js'])

<div class="container">

    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
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

    <div class="p-4 md:p-6 rounded-lg shadow-md mb-3 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300">
        <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-6">
            <div class="flex items-center space-x-2 md:space-x-4 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <h1 class="text-lg md:text-2xl font-semibold text-gray-900">Funcionários</h1>
            </div>
            <div class="flex flex-col space-y-2 w-full md:flex-row md:space-x-4 md:space-y-0 md:w-auto">
                <button id="filterBtn"
                    class="w-full md:w-auto px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                    Filtros
                </button>
                <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
                    class="w-full md:w-auto px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800 text-center">
                    Limpar
                </a>
            </div>
        </div>
    </div>



    <div id="filterModal" class="modal mx-auto lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('employees.index') }}">
                <input type="text" name="name" id="filter-name" placeholder="Filtrar por nome">
                <select name="role" id="filter-role">
                    <option value="">Filtrar por cargo</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('employees.deleteSelected') }}" method="POST"
        style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link"
            title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>

    @include('components.Modals.modal-delete')

    <div class="list-table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>NOME</th>
                    <th>NÚMERO</th>
                    <th>EMAIL</th>
                    <th>CARGO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $employee->id }}"
                                class="form-checkbox select-checkbox">
                        </td>
                        <td><a href="{{ url('employees/' . $employee->id) }}">{{ $employee->name }}</a></td>
                        <td>{{ $employee->employee_number }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->role->name }}</td>
                        <td class="table-actions">
                            <a href="{{ url('employees/' . $employee->id . '/edit') }}" class="btn-action btn-edit">
                                <i class="fas fa-edit text-xl"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete" data-id="{{ $employee->id }}">
                                <i class="fas fa-trash-alt text-xl"></i>
                            </button>
                            <form id="delete-form-{{ $employee->id }}" method="post"
                                action="{{ route('employees.destroy', $employee->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ url('employees/' . $employee->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye text-xl"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


        <div class="add-button-container fixed bottom-4 right-4 z-10">
            <button id="addButton" class="add-button">
                <i class="fas fa-plus"></i>
            </button>
            <div id="addOptions" class="add-options hidden absolute bg-white shadow-lg rounded p-2">
                <a href="{{ route('employees.create') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Criar manualmente</a>
                <button id="importCsvBtn" data-action="{{ route('employee.import') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    data-token="{{ csrf_token() }}">Importar CSV
                </button>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-4">
        {{ $employees->links() }}
    </div>
</div>

@include('components.Modals.modal-delete')

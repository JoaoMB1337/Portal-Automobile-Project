@vite(['resources/js/Geral/list.js'])

<div class="container">

    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <div class="form-container">
        <button id="filterBtn"
            class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
            class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar
        </a>
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
                    <th>Funcionario</th>
                    <th>Número</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Ações</th>
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
                <a href="{{ route('employees.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Criar Manualmente</a>
                <button id="importCsvBtn" data-action="{{ route('employee.import') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
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

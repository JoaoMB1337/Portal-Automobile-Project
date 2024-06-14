@vite(['resources/js/Employees/employees-list.js'])
<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
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

    <form id="multi-delete-form" action="{{ route('employees.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>

    @include('components.Modals.modal-delete')

    <div class="list-table">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
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
                        <input type="checkbox" name="selected_ids[]" value="{{ $employee->id }}" class="form-checkbox select-checkbox">
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
                        <form id="delete-form-{{ $employee->id }}" method="post" action="{{ route('employees.destroy', $employee->id) }}" style="display: none;">
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
                <button id="importCsvBtn" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Importar CSV</button>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-4">
        {{ $employees->links() }}
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .add-options {
        bottom: 60px;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .add-options a,
    .add-options button {
        display: block;
        margin-bottom: 5px;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
    }

    .add-button {
        background-color: #1a1c1a;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete:hover i {
        color: #c82333;
    }


    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .add-options {
        bottom: 60px;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .add-options a,
    .add-options button {
        display: block;
        margin-bottom: 5px;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
    }

    .add-button {
        background-color: #1a1c1a;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete:hover i {
        color: #c82333;
    }


    .btn-action {
        padding: 6px 12px;
        font-size: 16px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }



    .btn-edit i, .btn-view i {
        color: #282826;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete:hover i {
        color: #c82333;
    }



</style>


@include('components.Modals.modal-delete')

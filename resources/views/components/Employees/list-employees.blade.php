@vite(['resources/js/Employees/employees-list.js'])

<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="filter-button">Filtrar</button>
        <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Limpar
        </a>
    </div>

    <!-- IMPORT -->
    <form action="{{ route('employee.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="fileBtn">Import</button>
    </form>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:#c82333">{{ $error }}</p>
        @endforeach
    @endif

    @if (session()->has('error'))
        <p style="color:#c82333">{!! session('error') !!}</p>
    @endif

    @if (session()->has('sucesso'))
        <p style="color:#28a745">{!! session('sucesso') !!}</p>
    @endif

    <div id="filterModal" class="modal">
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
    @include('components.modals.modal-delete')

    <div class="list-table">
        <table>
            <thead>
            <tr>
                <th>
                    <label for="select-all-checkbox">
                        <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                    </label>
                </th>
                <th>Nome</th>
                <th>Número</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Ações</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr data-url="{{ url('employees/' . $employee->id) }}" style="cursor:pointer;">
                    <td>
                        <input type="checkbox" name="selected_ids[]" value="{{ $employee->id }}" class="form-checkbox select-checkbox">
                    </td>
                    <td><a href="{{ url('employees/' . $employee->id) }}">{{ $employee->name }}</a></td>
                    <td>{{ $employee->employee_number }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->role->name }}</td>
                    <td>
                        <a href="{{ url('employees/' . $employee->id . '/edit') }}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <a href="{{ route('employees.create') }}" class="add-button">
        <i class="fas fa-plus"></i>
    </a>
</div>


@vite(['resources/js/Employees/employees-list.js'])
<div class="container">

    <!-- Filtros -->
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-800 text-white rounded-md shadow-sm hover:bg-gray-700">Limpar
        </a>
    </div>

    <!-- IMPORT -->
    <form id="importCsvForm" action="{{ route('employee.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="fileBtn">Importar</button>
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

    <div id="filterModal" class="modal mx-auto pl-10 lg:pl-64">
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
</div>







<!-- Botão "Adicionar" com opções -->
<div class="add-button-container">
    <button id="addButton" class="add-button"><i class="fas fa-plus"></i></button>
    <div id="addOptions" class="add-options" style="display: none;">
        <a href="{{ route('employees.create') }}">Criar Manualmente</a>
        <button id="importCsvBtn">Importar CSV</button>
    </div>
</div>

<style>

    .add-options {
        position: absolute;
        right: 0;
        bottom: 70px;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: top 0.8s ease-in-out; /* Transição suave de movimento */
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

    .add-options a:hover,
    .add-options button:hover {
        background-color: #f0f0f0;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addOptions = document.getElementById("addOptions");
        // Adiciona evento de clique no botão "Adicionar"
        document.getElementById("addButton").addEventListener("click", function() {
            // Alterna a exibição das opções ao lado do botão
            if (addOptions.style.display === "block") {
                addOptions.style.display = "none"; // Esconde as opções
            } else {
                addOptions.style.display = "block"; // Exibe as opções
            }
        });

        // Adiciona evento de clique no botão de importar CSV
        document.getElementById("importCsvBtn").addEventListener("click", function() {
            // Exibe o formulário de importação de CSV
            document.getElementById("importCsvForm").style.display = "block";
            // Esconde as opções de adicionar
            addOptions.style.display = "none";
        });
    });
</script>

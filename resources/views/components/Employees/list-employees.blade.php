@vite(['resources/js/Employees/employees-list.js'])

<div class="container">

    <!-- Filtros -->
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar
        </a>
    </div>

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
<div class="flex justify-center mr-10 ">
    {{ $employees->links() }}
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
        position: absolute;
        right: 0;
        bottom: 70px;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: top 0.8s ease-in-out;
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
        // Modal Filter
        var filterBtn = document.getElementById("filterBtn");
        var filterModal = document.getElementById("filterModal");
        var closeSpan = document.getElementsByClassName("close")[0];

        filterBtn.onclick = function() {
            filterModal.style.display = "block";
        }

        closeSpan.onclick = function() {
            filterModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == filterModal) {
                filterModal.style.display = "none";
            }
        }

        // Add Button Options
        var addButton = document.getElementById("addButton");
        var addOptions = document.getElementById("addOptions");
        var importCsvBtn = document.getElementById("importCsvBtn");

        addButton.onclick = function() {
            if (addOptions.style.display === "block") {
                addOptions.style.display = "none";
            } else {
                addOptions.style.display = "block";
            }
        }

        importCsvBtn.onclick = function(event) {
            event.preventDefault();

            var importCsvForm = document.createElement("form");
            importCsvForm.method = "POST";
            importCsvForm.action = "{{ route('employees.importCsv') }}";
            importCsvForm.enctype = "multipart/form-data";
            importCsvForm.style.display = "none";

            var csrfTokenInput = document.createElement("input");
            csrfTokenInput.type = "hidden";
            csrfTokenInput.name = "_token";
            csrfTokenInput.value = "{{ csrf_token() }}";

            var fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "file";
            fileInput.accept = ".csv";

            var submitButton = document.createElement("button");
            submitButton.type = "submit";
            submitButton.textContent = "Importar";

            importCsvForm.appendChild(csrfTokenInput);
            importCsvForm.appendChild(fileInput);
            importCsvForm.appendChild(submitButton);

            document.body.appendChild(importCsvForm);

            fileInput.addEventListener("change", function() {
                importCsvForm.submit();
            });

            fileInput.click();
        }
    });
</script>


    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .form-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .form-container input[type="text"],
        .form-container select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 250px;
            margin-right: 10px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .employee-table {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow-x: auto;
        }

        .employee-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .employee-table th,
        .employee-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .employee-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .employee-table tr:hover {
            background-color: #f9f9f9;
        }

        .add-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 20px;
            right: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #0056b3;
        }


    </style>

    <div class="container">
        <div class="form-container">
            <form method="GET" action="{{ route('employees.index') }}">
                <input type="text" name="name" id="filter-name" placeholder="Filtrar por nome">
                <select name="role" id="filter-role">
                    <option value="">Filtrar por cargo</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <button type="submit"  >Filtrar</button>
            </form>
            <a href="{{ route('employees.index', ['clear_filters' => true]) }}"
                class="px-4 py-2 bg-blue-300 text-black-500 rounded-md shadow-sm hover:bg-blue-400">Limpar
                Filtros
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

        <form id="multi-delete-form" action="{{ route('employees.deleteSelected') }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selected_ids" id="selected-ids">
            <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover" style="display: none;" onclick="return confirm('Tem certeza que deseja excluir os funcionários selecionados?')">
                <i class="fas fa-trash-alt text-lg"></i>
            </button>
        </form>
        <div class="employee-table">
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
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_ids[]" value="{{ $employee->id }}" class="form-checkbox">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const checkboxes = document.querySelectorAll('.form-checkbox');
            const selectedIdsInput = document.getElementById('selected-ids');
            const deleteButton = document.querySelector('.delete-link');

            // Select all checkboxes functionality
            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                updateSelectedIds();
                toggleDeleteButton();
            });

            // Individual checkbox change event
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedIds();
                    toggleDeleteButton();
                });
            });

            // Update selected IDs input
            function updateSelectedIds() {
                const selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
                selectedIdsInput.value = JSON.stringify(selectedIds);
            }

            // Toggle delete button visibility
            function toggleDeleteButton() {
                const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                deleteButton.style.display = anyChecked ? 'inline-block' : 'none';
            }
        });
    </script>


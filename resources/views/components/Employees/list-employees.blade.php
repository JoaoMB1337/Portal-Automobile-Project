<div class="flex flex-col items-center mb-4">

    <div class="flex space-x-4 mb-4">
        <input type="text" id="filter-name" placeholder="Filtrar por nome" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select id="filter-role" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Filtrar por cargo</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

<div class="flex justify-center">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="overflow-x-auto">
            <form id="multi-delete-form" action="{{ route('employees.deleteSelected') }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_ids" id="selected-ids">
                <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-button hidden" title="Remover" onclick="return confirm('Tem certeza que deseja excluir os funcionários selecionados?')">
                    <i class="fas fa-trash-alt text-lg"></i>
                </button>
            </form>
            <a href="{{ route('employees.create') }}" class="text-gray-800 hover:text-red-900 ml-2" title="Adicionar">
                <i class="fas fa-plus text-lg"></i>
            </a>

            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        <label for="select-all-checkbox">
                            <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Cargo
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $employee->id }}" class="form-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-medium text-gray-900">{{ $employee->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $employee->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $employee->role->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ url('employees/' . $employee->id) }}" class="text-gray-700 hover:text-blue-900" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ url('employees/' . $employee->id . '/edit') }}" class="text-blue-900 hover:text-indigo-900 ml-2" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const checkboxes = document.querySelectorAll('.form-checkbox');
        const selectedIdsInput = document.getElementById('selected-ids');
        const deleteButton = document.querySelector('.delete-button');
        const filterNameInput = document.getElementById('filter-name');
        const filterRoleInput = document.getElementById('filter-role');
        const tableRows = document.querySelectorAll('tbody tr');

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
            deleteButton.classList.toggle('hidden', !anyChecked);
        }


        // Filter table functionality
        filterNameInput.addEventListener('input', filterTable);
        filterRoleInput.addEventListener('input', filterTable);

        function filterTable() {
            const nameFilter = filterNameInput.value.toLowerCase();
            const roleFilter = filterRoleInput.value.toLowerCase();

            tableRows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(2) .text-lg').textContent.toLowerCase();
                const roleCell = row.querySelector('td:nth-child(4) .text-lg').textContent.toLowerCase();

                const matchesName = nameCell.includes(nameFilter);
                const matchesRole = roleCell.includes(roleFilter);

                row.style.display = (matchesName && matchesRole) ? '' : 'none';
            });
        }
    });
</script>

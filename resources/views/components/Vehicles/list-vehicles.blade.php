
<div class="flex justify-center">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="overflow-x-auto">
            <div class="flex justify-center mb-4">
                <input type="text" id="search-plate" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pesquisar matrícula">
                <select id="filter-external" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" id="filter-all">Filtrar por Externo</option>
                    <option value="1" id="filter-external-yes" class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800">Sim</option>
                    <option value="0" id="filter-external-no" class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">Não</option>
                </select>
                <select id="filter-fuel" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Filtrar por Tipo de Combustível</option>
                    @foreach($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->type }}">{{ $fuelType->type }}</option>
                    @endforeach
                </select>
            </div>
            <form id="multi-delete-form" action="{{ route('vehicles.deleteSelected') }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_ids" id="selected-ids">
                <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-button hidden" title="Remover" onclick="return confirm('Tem certeza que deseja excluir os veículos selecionados?')">
                    <i class="fas fa-trash-alt text-lg"></i>
                </button>
            </form>
            <a href="{{ route('vehicles.create') }}" class="text-gray-800 hover:text-green-900 ml-2" title="Adicionar">
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
                        Matrícula
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Tipo de Combustível
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Externo
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($vehicles as $vehicle)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $vehicle->id }}" class="form-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-medium text-gray-900">{{ $vehicle->plate }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $vehicle->brand->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full">
                                {{ $vehicle->carCategory->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full">
                                {{ $vehicle->fuelType->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($vehicle->is_external)
                                <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Sim
                            </span>
                            @else
                                <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Não
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ url('vehicles/' . $vehicle->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ url('vehicles/' . $vehicle->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Editar">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            Nenhum veiculo encontrado.
                        </td>
                    </tr>
                @endforelse                </tbody>
            </table>
        </div>
        {{ $vehicles->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const checkboxes = document.querySelectorAll('.form-checkbox');
        const multiDeleteForm = document.getElementById('multi-delete-form');
        const selectedIdsInput = document.getElementById('selected-ids');
        const deleteButton = document.querySelector('.delete-button');
        const searchInput = document.getElementById('search-plate');
        const tableRows = document.querySelectorAll('tbody tr');
        const filterSelect = document.getElementById('filter-external');
        const filterFuelSelect = document.getElementById('filter-fuel');






        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedIds();
            toggleDeleteButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedIds();
                toggleDeleteButton();
            });
        });

        function updateSelectedIds() {
            const selectedIds = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedIds.push(checkbox.value);
                }
            });
            selectedIdsInput.value = JSON.stringify(selectedIds);
        }

        function toggleDeleteButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteButton.classList.toggle('hidden', !anyChecked);
        }

        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                const plate = row.querySelector('td:nth-child(2) .text-lg').textContent.toLowerCase();
                if (plate.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        filterSelect.addEventListener('change', function() {
            const filterValue = filterSelect.value;

            tableRows.forEach(row => {
                const isExternalCell = row.querySelector('td:nth-child(6)');
                if (!isExternalCell) return; // Verifica se a célula existe

                const isExternal = isExternalCell.textContent.trim().toLowerCase();
                if (filterValue === '' || (filterValue === '1' && isExternal === 'sim') || (filterValue === '0' && isExternal === 'não')) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        filterFuelSelect.addEventListener('change', function() {
            const filterFuelValue = filterFuelSelect.value;

            tableRows.forEach(row => {
                const fuelTypeCell = row.querySelector('td:nth-child(5)');
                if (!fuelTypeCell) return;

                const fuelType = fuelTypeCell.textContent.trim().toLowerCase();


                if (filterFuelValue === '' || fuelType === filterFuelValue.toLowerCase()) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

</script>

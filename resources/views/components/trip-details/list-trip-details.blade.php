<div class="flex justify-center mt-10">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg w-full max-w-6xl">
        <div class="overflow-x-auto">
            <div class="flex justify-between p-4">
                <a href="{{ route('trip-details.create') }}" class="text-gray-800 hover:text-green-900" title="Adicionar">
                    <i class="fas fa-plus text-lg"></i>
                </a>
            </div>

            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        <label for="select-all-checkbox">
                            <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Nome do Funcionário
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Tipo de custo  
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Custo total
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Viagem
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">     
                @foreach ($tripDetails as $tripDetail)
                    @php
                        $employeeName = $tripDetail->trip && $tripDetail->trip->employee ? $tripDetail->trip->employee->name : 'Funcionário não encontrado';
                        $tripName = $tripDetail->trip ? $tripDetail->trip->destination : 'Viagem não encontrada';
                        $costTypeName = $tripDetail->costType ? $tripDetail->costType->type_name : 'Tipo de custo não encontrado';
                        $cost = $tripDetail->cost;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $tripDetail->id }}" class="form-checkbox trip-detail-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employeeName }}</td> 
                        <td class="px-6 py-4 whitespace-nowrap">{{ $costTypeName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $cost }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tripName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('trip-details.show', $tripDetail->id) }}" class="text-indigo-600 hover:text-indigo-900">Detalhes</a>
                        </td>
                    </tr>
                @endforeach
                @if($tripDetails->isEmpty())
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Nenhum detalhe de viagem encontrado.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const tripDetailCheckboxes = document.querySelectorAll('.trip-detail-checkbox');
        const deleteButton = document.querySelector('.delete-button');

        function toggleDeleteButton() {
            const selectedIds = Array.from(tripDetailCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
            if (selectedIds.length > 0) {
                deleteButton.classList.remove('hidden');
            } else {
                deleteButton.classList.add('hidden');
            }
            document.getElementById('selected-ids').value = selectedIds.join(',');
        }

        selectAllCheckbox.addEventListener('click', function() {
            const checked = selectAllCheckbox.checked;
            tripDetailCheckboxes.forEach(checkbox => checkbox.checked = checked);
            toggleDeleteButton();
        });

        tripDetailCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleDeleteButton);
        });
    });
</script>

@props(['costTypes', 'projects', 'employees', 'tripDetails'])

<div class="flex justify-center mt-10">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg w-full max-w-6xl">
        <div class="overflow-x-auto">
            <div class="flex justify-between p-4">
                <a href="{{ route('costs-types.create') }}" class="text-gray-800 hover:text-green-900" title="Adicionar">
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
                        Projeto
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
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">     
                @forelse ($costTypes as $costType)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $costType->id }}" class="form-checkbox cost-type-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($costType->tripDetails->isNotEmpty() && $costType->tripDetails->first()->trip && $costType->tripDetails->first()->trip->project)
                                {{ $costType->tripDetails->first()->trip->project->name }}
                            @else
                                Projeto não encontrado
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($costType->tripDetails->isNotEmpty() && $costType->tripDetails->first()->trip && $costType->tripDetails->first()->trip->employee)
                                {{ $costType->tripDetails->first()->trip->employee->name }}
                            @else
                                Funcionário não encontrado
                            @endif
                        </td> 
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $costType->type_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $totalCost = $costType->tripDetails->sum('cost');
                            @endphp
                            {{ $totalCost }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Nenhum tipo de custo encontrado.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Toggle select all checkboxes
        $('#select-all-checkbox').on('click', function() {
            var checked = $(this).is(':checked');
            $('.cost-type-checkbox').prop('checked', checked);
            toggleDeleteButton();
        });

        // Toggle delete button based on individual checkbox selection
        $('.cost-type-checkbox').on('change', function() {
            toggleDeleteButton();
        });

        function toggleDeleteButton() {
            var selectedIds = $('.cost-type-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                $('.delete-button').removeClass('hidden');
            } else {
                $('.delete-button').addClass('hidden');
            }

            $('#selected-ids').val(selectedIds.join(','));
        }
    });
</script>

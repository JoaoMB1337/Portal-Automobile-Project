@vite('resources/js/Employees/employees-list.js')

<div class="container">
    <div class="form-container">
        <button id="filterBtn"
            class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('insurances.index', ['clear_filters' => true]) }}"
            class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar
        </a>
    </div>

    <div id="filterModal" class="modal mx-auto pl-10 lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('insurances.index') }}">
                <input type="text" name="insurance_company" id="filter-insurance_company"
                    placeholder="Filtrar por Companhia de Seguro">
                <input type="text" name="policy_number" id="filter-policy_number"
                    placeholder="Filtrar por Número da Apólice">
                <select name="ativo" id="filter-ativo">
                    <option disabled selected>Filtrar por Ativo</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('insurances.deleteSelected') }}" method="POST"
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
                <th>
                </th>
                <th>Companhia</th>
                <th>Número da Apólice</th>
                <th>Data de Início</th>
                <th>Data de Fim</th>
                <th>Custo</th>
                <th>Matrícula</th>
                <th>Ações</th>
            </tr>
                <tr>
                    <th>
                        <label for="select-all-checkbox">
                            <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th>Companhia</th>
                    <th>Número da Apólice</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Custo</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>

            </thead>
            <tbody>
                @forelse ($insurances as $insurance)
                    <tr data-url='{{ url('insurances/' . $insurance->id) }}' style="cursor:pointer;">
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $insurance->id }}"
                                class="form-checkbox">
                        </td>
                        <td>{{ $insurance->insurance_company }}</td>
                        <td>{{ $insurance->policy_number }}</td>
                        <td>{{ $insurance->start_date }}</td>
                        <td>{{ $insurance->end_date }}</td>
                        <td>{{ number_format($insurance->cost, 2, ',', '.') }}</td>
                        <td>{{ $insurance->vehicle->plate }}</td>
                        <td>
                            <a href="{{ route('insurances.edit', $insurance->id) }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('insurances.destroy', $insurance->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9"
                            class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            Nenhum seguro encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('insurances.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>

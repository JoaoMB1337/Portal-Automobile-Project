@vite(['resources/js/Geral/list.js'])

<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('vehicles.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar

        </a>
    </div>

    <div id="filterModal" class="modal mx-auto lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('vehicles.index') }}">
                <input type="text" name="search" id="filter-plate" placeholder="Pesquisar por matrícula">
                <select name="is_external" id="filter-is-external">
                    <option value="">Filtrar por externo/interno</option>
                    <option value="1" {{ request('is_external') == '1' ? 'selected' : '' }}>Externo</option>
                    <option value="0" {{ request('is_external') == '0' ? 'selected' : '' }}>Interno</option>
                </select>
                <select name="fuel_type" id="filter-fuel-type">
                    <option value="">Filtrar por combustível</option>
                    @foreach ($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}" {{ request('fuel_type') == $fuelType->id ? 'selected' : '' }}>
                            {{ $fuelType->type }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>



    <form id="multi-delete-form" action="{{ route('vehicles.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>

    @include('components.Modals.modal-delete')

    <a href="{{ route('vehicles.create') }}" class="add-button">
        <i class="fas fa-plus"></i>
    </a>

    <div class="list-table">
        <table>
            <thead>
            <tr>
                <th>
                </th>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Tipo de Combustível</th>
                <th>Externo</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($vehicles as $vehicle)
                <tr data-url='{{ url('vehicles/' . $vehicle->id) }}' style="cursor:pointer;">
                    <td>
                        <input type="checkbox" name="selected_ids[]" value="{{ $vehicle->id }}" class="form-checkbox">
                    </td>
                    <td><a href="{{ url('vehicles/' . $vehicle->id) }}">{{ $vehicle->plate }}</a></td>
                    <td>{{ $vehicle->brand->name }}</td>
                    <td>{{ $vehicle->carCategory->category }}</td>
                    <td>{{ $vehicle->fuelType->type }}</td>
                    <td>
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
                    <td class="table-actions">
                        <a href="{{ url('vehicles/' . $vehicle->id . '/edit') }}" class="btn-action btn-edit">
                            <i class="fas fa-edit text-xl"></i>
                        </a>
                        <button type="button" class="btn-action btn-delete" data-id="{{ $vehicle->id }}">
                            <i class="fas fa-trash-alt text-xl"></i>
                        </button>
                        <form id="delete-form-{{ $vehicle->id }}" method="post" action="{{ route('vehicles.destroy', $vehicle->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{ url('vehicles/' . $vehicle->id) }}" class="btn-action btn-view">
                            <i class="fas fa-eye text-xl"></i>
                        </a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        Nenhum veículo encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="flex justify-center mr-10 ">
    {{ $vehicles->links() }}
</div>


@include('components.Modals.modal-delete')



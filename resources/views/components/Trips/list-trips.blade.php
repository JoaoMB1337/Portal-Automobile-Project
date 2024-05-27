@vite(['resources/js/Employees/employees-list.js'])

<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="filter-button">Filtrar</button>
        <a href="{{ route('trips.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Limpar
        </a>
    </div>

    <div id="filterModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('trips.index') }}">
                <input type="text" name="destination" id="filter-destination" placeholder="Filtrar por destino">
                <input type="text" name="purpose" id="filter-purpose" placeholder="Filtrar por propósito">
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('trips.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids" id="selected-ids">
        <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover" style="display: none;" onclick="return confirm('Tem certeza que deseja excluir as viagens selecionadas?')">
            <i class="fas fa-trash-aslt text-lg"></i>
        </button>
    </form>

    <div class="trip-table">
        <table>
            <thead>
            <tr>
                <th>
                    <label for="select-all-checkbox">
                        <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                    </label>
                </th>
                <th>Data de Início</th>
                <th>Data de Fim</th>
                <th>Destino</th>
                <th>Propósito</th>
                <th>Projeto</th>
                <th>Funcionário</th>
                <th>Veículo Matrícula</th>
                <th>Custo da Viagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @if ($trips->isEmpty())
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px;">Nenhum projeto encontrado</td>
                </tr>
            @else
                @foreach ($trips as $trip)
                    <tr data-url={{ url('trips/' . $trip->id) }}' style="cursor:pointer;">
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $trip->id }}" class="form-checkbox">
                        </td>
                        <td>{{ $trip->start_date }}</td>
                        <td>{{ $trip->end_date }}</td>
                        <td>{{ $trip->destination }}</td>
                        <td>{{ $trip->purpose }}</td>
                        <td>{{ $trip->project->name }}</td>
                        <td>
                            @foreach ($trip->employees as $employee)
                                {{ $employee->name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($trip->vehicles as $vehicle)
                                {{ $vehicle->plate }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('trip-details.create', ['trip_id' => $trip->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Adicionar
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('trips/' . $trip->id . '/edit') }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ url('trips/' . $trip->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir esta viagem?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <a href="{{ route('trips.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>

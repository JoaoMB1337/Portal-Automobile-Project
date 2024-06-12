@vite(['resources/js/Employees/employees-list.js'])

<div class="container">
    @if(Auth::check() && Auth::user()->isAdmin())
        <div class="form-container">
            <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
            <a href="{{ route('trips.index', ['clear_filters' => true]) }}" class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar</a>
        </div>

        <div id="filterModal" class="modal mx-auto lg:pl-64">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="GET" action="{{ route('trips.index') }}">
                    <input type="text" name="destination" id="filter-destination" placeholder="Filtrar por destino">
                    <input type="text" name="project" id="filter-project" placeholder="Filtrar por projeto">
                    <button type="submit">Filtrar</button>
                </form>
            </div>
        </div>

        <form id="multi-delete-form" action="{{ route('trips.deleteSelected') }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selected_ids[]" id="selected-ids">
            <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover">
                <i class="fas fa-trash-alt text-lg"></i>
            </button>
        </form>
    @endif

    @include('components.Modals.modal-delete')

    <div class="list-table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Projeto</th>
                    <th>Funcionário</th>
                    <th>Veículo</th>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <th>Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($trips as $trip)
                    <tr data-url="{{ url('trips/' . $trip->id) }}" style="cursor:pointer;">
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $trip->id }}" class="form-checkbox">
                        </td>
                        <td><a href="{{ route('trips.show', $trip->id) }}">{{ $trip->project->name }}</a></td>
                        <td>
                            @foreach ($trip->employees as $employee)
                                {{ $employee->name }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($trip->vehicles as $vehicle)
                                {{ $vehicle->plate }}<br>
                            @endforeach
                        </td>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <td>
                                <a href="{{ url('trips/' . $trip->id . '/edit') }}"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn-delete" data-id="{{ $trip->id }}"><i class="fas fa-trash-alt"></i></button>
                                <form id="delete-form-{{ $trip->id }}" method="post" action="{{ route('trips.destroy', $trip->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ url('trips/' . $trip->id) }}"><i class="fas fa-eye"></i></a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            Nenhuma viagem encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="flex justify-center mt-4">
            {{ $trips->links() }}
        </div>
    </div>

    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('trips.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
    @endif
</div>

@vite('resources/js/Employees/employees-list.js')
<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('projects.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar
        </a>
    </div>

    <div id="filterModal" class="modal mx-auto pl-10 lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('projects.index') }}">
                <input type="text" name="search" id="filter-name" placeholder="Pesquisar">
                <select name="district_id" id="filter-role">
                    <option value="">Selecionar Distrito</option>
                    @foreach ($districts as $district)
                        @if ($district->country_id == request()->country_id)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endif
                    @endforeach
                </select>
                <select name="country_id" id="filter-role">
                    <option value="">Selecionar País</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('projects.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>
    @include('components.Modals.modal-delete')

    <a href="{{ route('projects.create') }}" class="add-button">
        <i class="fas fa-plus"></i>
    </a>

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
                <th>Endereço</th>
                <th>Status do Projeto</th>
                <th>Distrito</th>
                <th>País</th>
                <th>Add Viagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($projects as $project)
                <tr data-url='{{ url('projects/' . $project->id) }}'  style="cursor:pointer;">
                    <td>
                        <input type="checkbox" name="selected_ids[]" value="{{ $project->id }}"
                               class="form-checkbox">
                    </td>
                    <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                    <td>{{ $project->address }}</td>
                    <td>{{ $project->projectstatus->status_name }}</td>
                    <td>{{ $project->district->name }}</td>
                    <td>{{ $project->country->name }}</td>
                    <td>
                        <a href="{{ route('trips.create', ['project_id' => $project->id]) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-gray-700 ">
                            Adicionar Viagem
                        </a>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-link" title="Remover"
                                    onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        Nenhum projeto encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>



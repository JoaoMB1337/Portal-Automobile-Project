@vite('resources/js/Geral/list.js')

<div class="container">
    <div class="form-container">
        @if(Auth::check() && Auth::user()->isMaster())
            <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
            <a href="{{ route('projects.index', ['clear_filters' => true]) }}"
               class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar
            </a>
        @endif
    </div>

    @if(Auth::check() && Auth::user()->isMaster())
        <div id="filterModal" class="modal mx-auto lg:pl-64">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="GET" action="{{ route('projects.index') }}">
                    <input type="text" name="search" id="filter-name" placeholder="Pesquisar">
                    <select name="district_id" id="filter-district">
                        <option value="">Selecionar Distrito</option>
                        @foreach ($districts as $district)
                            @if ($district->country_id == request()->country_id)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <select name="country_id" id="filter-country">
                        <option value="">Selecionar País</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="start_date" id="filter-start-date" placeholder="Data de Início">
                    <input type="date" name="end_date" id="filter-end-date" placeholder="Data de Fim">
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
    @endif

    <div class="list-table">
        <table>
            <thead>
            <tr>
                @if(Auth::check() && Auth::user()->isMaster())
                    <th>
                    </th>
                @endif
                <th>Nome</th>
                <th>Distrito</th>
                <th>País</th>
                    @if(Auth::check() && Auth::user()->isMaster())

                    <th>Viagem</th>
                    @endif

                    <th>Ações</th>

            </tr>
            </thead>
            <tbody>
            @forelse ($projects as $project)
                <tr data-url='{{ url('projects/' . $project->id) }}' style="cursor:pointer;">
                    @if(Auth::check() && Auth::user()->isMaster())
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $project->id }}" class="form-checkbox">
                        </td>
                    @endif
                    <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                    <td>{{ optional($project->district)->name ?? 'Sem Distrito' }}</td>
                    <td>{{ $project->country->name }}</td>
                    @if(Auth::check() && Auth::user()->isMaster())
                            <td>
                                <a href="{{ route('trips.create', ['project_id' => $project->id]) }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-700 border rounded-md text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                    Adicionar
                                </a>
                            </td>
                        @endif
                            <td class="table-actions">
                                @if(Auth::check() && Auth::user()->isMaster())

                                <a href="{{ route('projects.edit', $project->id) }}" class="p-2">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>
                                <button type="button" class="btn-delete p-2" data-id="{{ $project->id }}">
                                    <i class="fas fa-trash-alt text-xl"></i>
                                </button>
                                <form id="delete-form-{{ $project->id }}" method="post" action="{{ route('projects.destroy', $project->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif

                                <a href="{{ url('projects/' . $project->id) }}" class="p-2">
                                    <i class="fas fa-eye text-xl"></i>
                                </a>
                            </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        Nenhum projeto encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="flex justify-center mr-10 ">
    {{ $projects->links() }}
</div>


@include('components.Modals.modal-delete')

<style>
    .btn-delete i {
        color: #dc3545;
    }
</style>


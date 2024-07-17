@vite('resources/js/Geral/list.js')

<div class="container">
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-4 md:p-6 rounded-lg shadow-md mb-3 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300">
        <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-6">
            <div class="flex items-center space-x-2 md:space-x-4 mb-4 md:mb-0">
                <svg class="w-8 h-8 text-gray-700" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 505 505" xml:space="preserve" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <circle style="fill:#324A5E;" cx="252.5" cy="252.5" r="252.5"></circle>
                        <rect x="161.2" y="139.1" style="fill:#E6E9EE;" width="218.3" height="262.6"></rect>
                        <rect x="125.5" y="103.3" style="fill:#FFFFFF;" width="218.3" height="262.6"></rect>
                        <g>
                            <rect x="149.5" y="143.3" style="fill:#4CDBC4;" width="170.2" height="16.2"></rect>
                            <rect x="149.5" y="198.8" style="fill:#4CDBC4;" width="170.2" height="16.2"></rect>
                            <rect x="149.5" y="254.3" style="fill:#4CDBC4;" width="170.2" height="16.2"></rect>
                            <rect x="149.5" y="309.8" style="fill:#4CDBC4;" width="170.2" height="16.2"></rect>
                        </g>
                    </g>
            </svg>
                <h1 class="text-lg md:text-2xl font-semibold text-gray-900">Projetos</h1>
            </div>
            <div class="flex flex-col space-y-2 w-full md:flex-row md:space-x-4 md:space-y-0 md:w-auto">
                <button id="filterBtn" class="w-full md:w-auto px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                    Filtros
                </button>
                <a href="{{ route('projects.index', ['clear_filters' => true]) }}"
                   class="w-full md:w-auto px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800 text-center">
                    Limpar
                </a>
            </div>
        </div>
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
                    <input type="date" name="start_date" id="filter-start-date" placeholder="Data de Início" value="{{ old('start_date') ?? request('start_date') }}">
                    <input type="date" name="end_date" id="filter-end-date" placeholder="Data de Fim" value="{{ old('end_date') ?? request('end_date') }}">
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
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado" class="w-64 h-64 mx-auto">
                        <p class="mt-4 text-center">Nenhum projeto encontrado</p>
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


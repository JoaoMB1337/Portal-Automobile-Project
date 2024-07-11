@vite(['resources/js/Geral/list.js'])

<div class="container">
    @if(Auth::check() && Auth::user()->isMaster())

        <div class="p-4 md:p-6 rounded-lg shadow-md mb-3 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300">
            <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-6">
                <div class="flex items-center space-x-2 md:space-x-4 mb-4 md:mb-0">

                    <svg class=" w-6 h-6 text-gray-70"0 version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <path class="st0" d="M311.508,354.916l5.72-11.034c1.816-3.546,3.506-7.029,5.096-10.582c3.117-7.076,5.666-14.261,7.271-21.36 c3.265-14.331,1.566-27.476-7.146-37.21c-8.712-9.928-23.097-16.591-37.966-21.235c-31.654-9.11-64.024-19.248-95.343-31.139 c-7.862-2.985-15.686-6.086-23.479-9.39c-7.676-3.226-15.998-6.997-23.612-12.102c-7.527-5.088-15.421-11.868-19.496-22.263 c-2.019-5.112-2.549-10.894-1.87-16.147c0.685-5.267,2.4-10.06,4.528-14.331c4.426-8.751,9.857-15.063,14.751-21.835l15.235-19.871 l30.789-39.322l52.421-65.949L198.445,0c0,0-91.026,83.709-131.657,136.535c-35.324,45.914-16.03,86.483,47.87,113.772 c53.933,23.043,104.414,40.88,104.414,40.88c8.697,4.504,14.884,12.398,16.941,21.609c2.057,9.219-0.218,18.812-6.242,26.3 L90.719,512h138.733l59.006-112.868L311.508,354.916z"></path> <path class="st0" d="M444.973,261.023c-19.365-32.394-52.515-55.242-90.917-62.669l-136.052-28.684 c-5.673-1.091-10.442-4.691-12.85-9.694c-2.408-4.995-2.151-10.786,0.678-15.578l90.442-141.6l-44.052-1.262l-55.694,73.672 l-29.752,39.96l-14.627,20.082c-4.707,6.756-9.897,13.435-12.757,19.684c-3.046,6.46-3.81,12.617-1.612,17.728 c2.119,5.237,7.301,10.107,13.551,14.02c6.328,4.005,13.287,7.02,21.002,10.044c7.59,3,15.289,5.845,23.043,8.572 c31.155,10.948,62.536,19.956,95,28.459c16.645,4.956,34.264,11.595,48.299,26.402c6.842,7.41,11.946,17.143,13.886,27.219 c1.995,10.084,1.341,20.012-0.405,29.191c-1.839,9.172-4.714,17.791-8.089,26.004c-1.706,4.083-3.546,8.128-5.431,12.024 l-5.486,11.245l-21.983,44.8L261.284,512h140.626l53.192-144.646C468.031,332.178,464.337,293.416,444.973,261.023z"></path> </g> </g></svg>
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-900">Viagens</h1>
                </div>
                <div class="flex flex-col space-y-2 w-full md:flex-row md:space-x-4 md:space-y-0 md:w-auto">
                    <button id="filterBtn" class="w-full md:w-auto px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                        Filtrar
                    </button>
                    <a href="{{ route('trips.index', ['clear_filters' => true]) }}"
                       class="w-full md:w-auto px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800 text-center">
                        Limpar
                    </a>
                </div>
            </div>
        </div>


        <div id="filterModal" class="modal mx-auto lg:pl-64">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="GET" action="{{ route('trips.index') }}">
                    <input type="text" name="destination" id="filter-destination" placeholder="Filtrar por destino">
                    <input type="text" name="project" id="filter-project" placeholder="Filtrar por projeto">
                    <input type="date" name="start_date" id="filter-start-date" placeholder="Data de início">
                    <input type="date" name="end_date" id="filter-end-date" placeholder="Data de fim">
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
                <th>Data Inicial</th>
                @if(Auth::check() && Auth::user()->isMaster())
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
                    <td>{{ date('d/m/Y', strtotime($trip->start_date)) }}</td>

                    <td class="table-actions">
                        @if(Auth::check() && Auth::user()->isMaster())
                            <a href="{{ url('trips/' . $trip->id . '/edit') }}" class="btn-action btn-edit">
                                <i class="fas fa-edit text-xl"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete" data-id="{{ $trip->id }}">
                                <i class="fas fa-trash-alt text-xl"></i>
                            </button>
                            <form id="delete-form-{{ $trip->id }}" method="post" action="{{ route('trips.destroy', $trip->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                        <a href="{{ url('trips/' . $trip->id) }}" class="btn-action btn-view">
                            <i class="fas fa-eye text-xl"></i>
                        </a>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado" class="w-64 h-64 mx-auto">
                        <p class="mt-4 text-center">Nenhum registro encontrado</p>
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

<style>

    .btn-action {
        padding: 6px 12px;
        font-size: 16px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    .btn-edit i, .btn-view i {
        color: #2d2d2d;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete:hover i {
        color: #c82333;
    }

    .btn-edit:hover i, .btn-view:hover i {
        color: #2d2c2a;
    }

</style>

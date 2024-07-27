@vite(['resources/js/Geral/list.js'])

<body>
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
                    <svg class="w-16 h-16 text-gray-700" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <circle style="fill:#CCCCCC;" cx="256" cy="256" r="256"></circle>
                            <rect x="63.918" y="112.076" style="fill:#FFFFFF;" width="383.996" height="287.999"></rect>
                            <g>
                                <rect x="99.922" y="163.999" style="fill:#CCCCCC;" width="140" height="8"></rect>
                                <rect x="99.922" y="187.998" style="fill:#CCCCCC;" width="140" height="8"></rect>
                                <rect x="99.922" y="211.997" style="fill:#CCCCCC;" width="140" height="8"></rect>
                                <rect x="99.922" y="235.996" style="fill:#CCCCCC;" width="140" height="8"></rect>
                                <rect x="99.922" y="260.005" style="fill:#CCCCCC;" width="155.999" height="8">
                                </rect>
                                <rect x="99.922" y="284.004" style="fill:#CCCCCC;" width="179.998" height="8">
                                </rect>
                                <rect x="99.922" y="308.004" style="fill:#CCCCCC;" width="316.003" height="8">
                                </rect>
                                <rect x="99.922" y="332.003" style="fill:#CCCCCC;" width="316.003" height="8">
                                </rect>
                                <rect x="99.922" y="356.002" style="fill:#CCCCCC;" width="316.003" height="8">
                                </rect>
                            </g>
                            <circle style="fill:#E21B1B;" cx="344.964" cy="216.002" r="58"></circle>
                            <path style="fill:#FFFFFF;"
                                d="M341.68,255.201v-9.68c-5.18-0.02-10.251-1.488-14.64-4.24l2.32-6.4 c4.094,2.664,8.875,4.082,13.76,4.08c6.8,0,11.36-3.92,11.36-9.36c0-5.28-3.76-8.48-10.8-11.36c-9.68-3.76-15.76-8.08-15.76-16.4 c0.116-8.069,6.355-14.725,14.4-15.36v-9.68h5.92v9.28c4.356,0.023,8.629,1.182,12.4,3.36l-2.4,6.32 c-3.627-2.166-7.776-3.299-12-3.28c-7.36,0-10.16,4.4-10.16,8.24c0,4.96,3.52,7.44,11.84,10.88c9.84,4,14.8,8.96,14.8,17.44 c-0.168,8.474-6.68,15.467-15.12,16.241v9.92L341.68,255.201L341.68,255.201z">
                            </path>
                        </g>
                    </svg>
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-900">Seguros</h1>
                </div>
                <div class="flex flex-col space-y-2 w-full md:flex-row md:space-x-4 md:space-y-0 md:w-auto">
                    <button id="filterBtn"
                        class="w-full md:w-auto px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                        Filtros
                    </button>
                    <a href="{{ route('insurances.index', ['clear_filters' => true]) }}"
                        class="w-full md:w-auto px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800 text-center">
                        Limpar
                    </a>
                </div>
            </div>
        </div>

        <div id="filterModal" class="modal mx-auto lg:pl-64">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="GET" action="{{ route('insurances.index') }}">
                    <input type="text" name="insurance_company" id="filter-insurance_company"
                        placeholder="Filtrar por Companhia de Seguro">
                    <input type="text" name="policy_number" id="filter-policy_number"
                        placeholder="Filtrar por Número da Apólice">
                    <select name="ativo" id="filter-ativo">
                        <option disabled selected>Filtrar por estado</option>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                    <label for="filter-terminando">Seguros terminando em 30 dias:</label>
                    <input type="checkbox" name="terminando" id="filter-terminando">
                    <label for="filter-ending_today">Seguros que terminam hoje:</label>
                    <input type="checkbox" name="ending_today" id="filter-ending_today">
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

        <div class="list-table-container">
            <div class="list-table">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>COMPANHIA</th>
                            <th>NÚMERO DA APÓLICE</th>
                            <th>CUSTO</th>
                            <th>MATRÍCULA</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($insurances as $insurance)
                            <tr data-url='{{ url('insurances/' . $insurance->id) }}' style="cursor:pointer;">
                                <td>
                                    <input type="checkbox" name="selected_ids[]" value="{{ $insurance->id }}"
                                        class="form-checkbox">
                                </td>
                                <td><a href="{{ route('insurances.show', $insurance->id) }}">{{ $insurance->insurance_company ?? 'N/A' }}
                                </td>
                                <td>{{ $insurance->policy_number ?? 'N/A' }}</td>
                                <td>{{ number_format($insurance->cost ?? 0, 2, ',', '.') }}</td>
                                <td>{{ $insurance->vehicle->plate ?? 'N/A' }}</td>
                                <td class="table-actions">
                                    <a href="{{ route('insurances.edit', $insurance->id) }}" class="p-2">
                                        <i class="fas fa-edit text-xl"></i>
                                    </a>
                                    <button type="button" class="btn-delete p-2" data-id="{{ $insurance->id }}">
                                        <i class="fas fa-trash-alt text-xl text-red-600"></i>
                                    </button>
                                    <form id="delete-form-{{ $insurance->id }}" method="post"
                                        action="{{ route('insurances.destroy', $insurance->id) }}"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ url('insurances/' . $insurance->id) }}" class="p-2">
                                        <i class="fas fa-eye text-xl"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                                    <img src="{{ asset('images/notfounditem.png') }}"
                                        alt="Nenhum registro encontrado" class="w-64 h-64 mx-auto">
                                    <p class="mt-4 text-center">Nenhum seguro encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-container">
                <div class="flex justify-center mt-4">
                    {{ $insurances->links() }}
                </div>
            </div>
        </div>
        <a href="{{ route('insurances.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
    </div>
</body>

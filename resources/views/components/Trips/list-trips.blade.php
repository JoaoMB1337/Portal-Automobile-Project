
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .form-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            gap: 10px;
        }

        .filter-button {
            padding: 10px 20px;
            background-color: #232f3a;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-button:hover {
            background-color: #333940;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        .modal-content {
            background-color: #e3e0e0;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            animation: slideIn 0.2s;
        }

        @keyframes slideIn {
            from {transform: translateY(-50px);}
            to {transform: translateY(0);}
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal input[type="text"],
        .modal select {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal button[type="submit"] {
            padding: 10px;
            background-color: #232f3a;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal button[type="submit"]:hover {
            background-color: #393e43;
        }

        .trip-table {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow-x: auto;
        }

        .trip-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .trip-table th,
        .trip-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .trip-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .trip-table tr:hover {
            background-color: #f9f9f9;
        }

        .add-button {
            background-color: #232f3a;
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 20px;
            right: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #101d2b;
        }

        .delete-link {
            color: #c82333;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .delete-link:hover {
            color: #a71d2a;
        }
    </style>

<body>
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

            <a href="{{ route('trips.create') }}" class="text-gray-800 hover:text-green-900 ml-2" title="Adicionar">
                <i class="fas fa-plus text-lg"></i>
            </a>

            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        <label for="select-all-checkbox">
                            <input type="checkbox" id="select-all-checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Data de Início
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Data de Fim
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Destino
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Propósito
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Projeto
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Funcionário
                    </th>

                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Veículo Matricula
                    </th>

                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($trips as $trip)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $trip->id }}" class="form-checkbox">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->start_date }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->end_date }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->destination }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->purpose }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->project->name }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($trip->employees as $employee)
                                <div class="text-lg text-gray-900">{{ $employee->name }}</div>
                            @endforeach
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($trip->vehicles as $vehicle)
                                <div class="text-lg text-gray-900">{{ $vehicle->plate }}</div>
                            @endforeach
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ url('trips/' . $trip->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ url('trips/' . $trip->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ url('trips/' . $trip->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2" title="Remover">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            Nenhumha viagem programada
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('trips.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids" id="selected-ids">
        <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover" style="display: none;" onclick="return confirm('Tem certeza que deseja excluir as viagens selecionadas?')">
            <i class="fas fa-trash-alt text-lg"></i>
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
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($trips as $trip)
                <tr onclick="window.location='{{ url('trips/' . $trip->id) }}';" style="cursor:pointer;">
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
                    <td>{{ $trip->vehicle }}</td>
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
            </tbody>
        </table>
    </div>
    <a href="{{ route('trips.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtn = document.getElementById('filterBtn');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementsByClassName('close')[0];

        filterBtn.onclick = function() {
            filterModal.style.display = 'block';
        }

        closeModal.onclick = function() {
            filterModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == filterModal) {
                filterModal.style.display = 'none';
            }
        }

        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        const selectedIdsInput = document.getElementById('selected-ids');
        const deleteButton = document.querySelector('.delete-link');

        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateSelectedIds();
            toggleDeleteButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAllCheckbox.checked = false;
                }
                updateSelectedIds();
                toggleDeleteButton();
            });
        });

        function updateSelectedIds() {
            const selectedIds = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);
            selectedIdsInput.value = JSON.stringify(selectedIds);
        }

        function toggleDeleteButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteButton.style.display = anyChecked ? 'inline-block' : 'none';
        }
    });
</script>

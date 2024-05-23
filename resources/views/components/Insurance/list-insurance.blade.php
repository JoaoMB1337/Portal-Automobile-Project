
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

<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="filter-button">Filtrar</button>
        <a href="{{ route('insurances.index', ['clear_filters' => true]) }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Limpar
        </a>
    </div>

    <div id="filterModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('insurances.index') }}">
                <input type="text" name="insurance_company" id="filter-insurance_company" placeholder="Filtrar por Companhia de Seguro">
                <input type="text" name="policy_number" id="filter-policy_number" placeholder="Filtrar por Número da Apólice">
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('insurances.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids" id="selected-ids">
        <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover" style="display: none;" onclick="return confirm('Tem certeza que deseja excluir os seguros selecionados?')">
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
            @foreach ($insurances as $insurance)
                <tr onclick="window.location='{{ url('insurances/' . $insurance->id) }}';" style="cursor:pointer;">

                <td>
                        <input type="checkbox" name="selected_ids[]" value="{{ $insurance->id }}" class="form-checkbox">
                    </td>
                    <td>{{ $insurance->insurance_company }}</td>
                    <td>{{ $insurance->policy_number }}</td>
                    <td>{{ $insurance->start_date }}</td>
                    <td>{{ $insurance->end_date }}</td>
                    <td>{{ $insurance->cost }}</td>
                    <td>{{ $insurance->vehicle->plate }}</td>
                    <td>
                        <a href="{{ route('insurances.edit', $insurance->id) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('insurances.destroy', $insurance->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este seguro?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('insurances.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
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

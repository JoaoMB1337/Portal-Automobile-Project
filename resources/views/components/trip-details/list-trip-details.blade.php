
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

    </style>

<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="filter-button">Filtrar</button>
        <a href="{{ route('trip-details.index', ['clear_filters' => true]) }}"            class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Limpar
        </a>
    </div>

    <div id="filterModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('trip-details.index') }}">
                <input type="text" name="destination" id="filter-destination" placeholder="Filtrar por destino">
                <input type="text" name="purpose" id="filter-purpose" placeholder="Filtrar por propósito">
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>



    <div class="trip-table">
        <table>
            <thead>
            <tr>

                <th>Nome do Funcionário</th>
                <th>Tipo de Custo</th>
                <th>Custo Total</th>
                <th>Viagem</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tripDetails as $tripDetail)
                <tr onclick="window.location='{{ url('tripDetails/' . $tripDetail->id) }}';" style="cursor:pointer;">

                @php
                    $employeeName = $tripDetail->trip && $tripDetail->trip->employee ? $tripDetail->trip->employee->name : 'Funcionário não encontrado';
                    $tripName = $tripDetail->trip ? $tripDetail->trip->destination : 'Viagem não encontrada';
                    $costTypeName = $tripDetail->costType ? $tripDetail->costType->type_name : 'Tipo de custo não encontrado';
                    $cost = $tripDetail->cost;
                @endphp
                <tr>

                    <td>{{ $employeeName }}</td>
                    <td>{{ $costTypeName }}</td>
                    <td>{{ $cost }}</td>
                    <td>{{ $tripName }}</td>
                    <td>
                        <a href="{{ route('trip-details.show', $tripDetail->id) }}" class="text-indigo-600 hover:text-indigo-900">Detalhes</a>
                    </td>
                </tr>
            @endforeach
            @if($tripDetails->isEmpty())
                <tr>
                    <td colspan="6" class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">Nenhum detalhe de viagem encontrado.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <a href="{{ route('trip-details.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtn = document.getElementById('filterBtn');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementsByClassName('close')[0];

        filterBtn.onclick = function () {
            filterModal.style.display = 'block';
        }

        closeModal.onclick = function () {
            filterModal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == filterModal) {
                filterModal.style.display = 'none';
            }
        }


    });
</script>


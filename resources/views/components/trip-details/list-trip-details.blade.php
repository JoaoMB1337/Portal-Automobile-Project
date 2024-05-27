@vite('resources/js/Employees/employees-list.js')

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

    <div class="list-table">
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


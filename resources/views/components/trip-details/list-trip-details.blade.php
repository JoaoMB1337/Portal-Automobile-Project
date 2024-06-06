<div class="container">
    @if(Auth::check() && Auth::user()->isAdmin())

    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('trip-details.index', ['clear_filters' => true]) }}" class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar</a>
    </div>

    <div id="filterModal" class="modal mx-auto pl-10 lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('trip-details.index') }}">
                <input type="text" name="destination" id="filter-destination" placeholder="Filtrar por destino">
                <input type="text" name="purpose" id="filter-purpose" placeholder="Filtrar por propósito">
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>
    @endif
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
            @forelse ($tripDetails as $tripDetail)
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
                        <!-- Ações -->
                        <a href="{{ route('trip-details.show', $tripDetail->id) }}" class="text-indigo-600 hover:text-indigo-900">Detalhes</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                        Nenhum detalhe encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
        @if(Auth::check() && Auth::user()->isAdmin())
    <a href="{{ route('trip-details.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
    @endif
</div>

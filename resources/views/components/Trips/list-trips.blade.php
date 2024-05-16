<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex justify-center">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                    <tr>
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
                            Ações
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($trips as $trip)
                        <tr>
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
                                <div class="text-lg text-gray-900">
                                    {{ $trip->project->name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg text-gray-900">
                                    {{ $trip->employee->name }}
                                </div>
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
                    @endforeach
                    </tbody>
                    <div class="flex justify-center-end mb-4">
                        <a href="{{ route('trips.create') }}" class="custom-btn">Adicionar Viagem</a>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex justify-center">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 w-full">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Data de Saída
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Data de Retorno
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
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $trip->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->start_date }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg text-gray-900">{{ $trip->end_date }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                            <a href="{{ url('trips/' . $trip->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                <i class="fas fa-eye
                                "></i>
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
            </table>
        </div>
    </div>
</div>
<div class="flex justify-end mb-4">
    <a href="{{ url('trips/create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-plus"></i> Adicionar
    </a>
</div>

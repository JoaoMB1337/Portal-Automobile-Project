<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex justify-center">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Matricula
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Marca
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Tipo de Combustível
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $vehicle->plate }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg text-gray-900">{{ $vehicle->brand->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $vehicle->car_category->category }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $vehicle->type_fuel->type }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                                <a href="{{ url('vehicles/' . $vehicle->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                <a href="{{ url('vehicles/' . $vehicle->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900 ml-2" title="Editar">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ url('vehicles/' . $vehicle->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2" title="Remover">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <div class="flex justify-content-end mb-4">
                        <a href="{{ url('vehicles/create') }}"  class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-500 transition duration-200">
                            <i class="fas fa-plus mr-2"></i> Adicionar
                        </a>
                    </div>
                    </table>
                </div>
            </div>
        </div>

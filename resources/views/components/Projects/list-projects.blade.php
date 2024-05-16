<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Projetos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="flex justify-center">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Endereço
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Status do Projeto
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Distrito
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                País
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($projects as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $project->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-900">{{ $project->address }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-900">{{ $project->projectstatus->status_name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-900">{{ $project->district->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-900">{{ $project->country->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-medium">
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900" title="Ver">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 ml-2" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2"
                                            title="Remover">
                                            <i class="fas fa-trash-alt text-lg"></i>
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

    <div class="flex justify-content-end mb-4">
        <a href="{{ route('projects.create') }}"
            class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-500 transition duration-200">
            <i class="fas fa-plus mr-2"></i> Adicionar Projeto
        </a>
    </div>
</body>

</html>

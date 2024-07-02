<form action="{{ route('project.report.filter') }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm max-w-md mx-auto">
    @csrf
    <h1 class="text-2xl text-center mb-6">Gerar Relatório de Viagens por Projeto</h1>

    <div class="mb-4">
        <label for="project_id" class="block text-gray-600 text-sm">Projeto:</label>
        <select id="project_id" name="project_id" required class="mt-1 p-3 border border-gray-300 rounded w-full text-sm">
            <option value="">Selecione um projeto</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="w-full bg-gray-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gray-700 text-sm">Filtrar</button>
</form>

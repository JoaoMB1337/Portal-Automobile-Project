<form action="{{ route('project.report.filter') }}" method="POST"
    class="bg-white p-10 rounded-lg shadow-md max-w-xl mx-auto">
    @csrf
    <h1 class="text-3xl text-center text-gray-800 mb-6">Gerar relatório de viagens por projeto</h1>

    <div class="form-group">
    <label for="project_name" class="block text-sm font-medium text-gray-700">Nome do projeto:</label>
    <input type="text" name="project_name" id="project_name"
           class="form-control mt-1 block w-full rounded-md border-gray-200 border-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
           value="{{ old('project_name') }}">
</div>

    <div class="mb-5">
        <label for="project_id" class="block text-gray-700 text-sm font-medium mb-2">Projeto:</label>
        <select id="project_id" name="project_id"
            class="block w-full p-3 border border-gray-300 rounded-md focus:ring-gray-400 focus:border-gray-400 text-sm">
            <option value="">Selecione um projeto</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}"
                    {{ old('project_id', $projectId) == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')
            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-gradient-to-l text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105">Pesquisar</button>
</form>


<script type="application/json" id="projects-data">@json($projects)</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const projects = JSON.parse(document.getElementById('projects-data').textContent);

        document.getElementById('project_name').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const selectElement = document.getElementById('project_id');

            selectElement.innerHTML = '<option value="" disabled selected>Selecione um projeto</option>';

            let foundMatch = false;

            projects.forEach(project => {
                if (project.name.toLowerCase().includes(searchValue)) {
                    const option = document.createElement('option');
                    option.value = project.id;
                    option.text = project.name;
                    selectElement.appendChild(option);

                    if (!foundMatch) {
                        selectElement.value = project.id;
                        foundMatch = true;
                    }
                }
            });

            if (!foundMatch) {
                selectElement.value = "";
            }
        });
    });
</script>



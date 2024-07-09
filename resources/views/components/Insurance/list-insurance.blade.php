@vite(['resources/js/Geral/list.js'])

<body>
<div class="container">
    <div class="form-container">
        <button id="filterBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">Filtrar</button>
        <a href="{{ route('insurances.index', ['clear_filters' => true]) }}" class="px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800">Limpar</a>
    </div>

    <div id="filterModal" class="modal mx-auto lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('insurances.index') }}">
                <input type="text" name="insurance_company" id="filter-insurance_company" placeholder="Filtrar por Companhia de Seguro">
                <input type="text" name="policy_number" id="filter-policy_number" placeholder="Filtrar por Número da Apólice">
                <select name="ativo" id="filter-ativo">
                    <option disabled selected>Filtrar por Ativo</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
                <label for="filter-terminando">Seguros Terminando em 30 dias:</label>
                 <input type="checkbox" name="terminando" id="filter-terminando">

                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('insurances.deleteSelected') }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link" title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>
    @include('components.Modals.modal-delete')

    <div class="list-table-container">
        <div class="list-table">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Companhia</th>
                    <th>Número da Apólice</th>
                    <th>Custo</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($insurances as $insurance)
                    <tr data-url='{{ url('insurances/' . $insurance->id) }}' style="cursor:pointer;">
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $insurance->id }}" class="form-checkbox">
                        </td>
                        <td><a href="{{ route('insurances.show', $insurance->id) }}">{{ $insurance->insurance_company }}</td>
                        <td>{{ $insurance->policy_number }}</td>
                        <td>{{ number_format($insurance->cost, 2, ',', '.') }}</td>
                        <td>{{ $insurance->vehicle->plate }}</td>
                        <td class="table-actions">
                            <a href="{{ route('insurances.edit', $insurance->id) }}" class="p-2">
                                <i class="fas fa-edit text-xl"></i>
                            </a>
                            <button type="button" class="btn-delete p-2" data-id="{{ $insurance->id }}">
                                <i class="fas fa-trash-alt text-xl text-red-600"></i>
                            </button>
                            <form id="delete-form-{{ $insurance->id }}" method="post" action="{{ route('insurances.destroy', $insurance->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ url('insurances/' . $insurance->id) }}" class="p-2">
                                <i class="fas fa-eye text-xl"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado" class="w-64 h-64 mx-auto">
                            <p class="mt-4 text-center">Nenhum seguro encontrado</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <div class="flex justify-center mt-4">
                {{ $insurances->links() }}
            </div>
        </div>
    </div>
    <a href="{{ route('insurances.create') }}" class="add-button"><i class="fas fa-plus"></i></a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Modal Filter
        var filterBtn = document.getElementById("filterBtn");
        var filterModal = document.getElementById("filterModal");
        var closeSpan = document.getElementsByClassName("close")[0];

        filterBtn.onclick = function () {
            filterModal.style.display = "block";
        }

        closeSpan.onclick = function () {
            filterModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == filterModal) {
                filterModal.style.display = "none";
            }
        }

        // Add Button Options
        var addButton = document.getElementById("addButton");
        var addOptions = document.getElementById("addOptions");
        var importCsvBtn = document.getElementById("importCsvBtn");

        addButton.onclick = function () {
            if (addOptions.style.display === "block") {
                addOptions.style.display = "none";
            } else {
                addOptions.style.display = "block";
            }
        }

        importCsvBtn.onclick = function (event) {
            event.preventDefault();

            var importCsvForm = document.createElement("form");
            importCsvForm.method = "POST";
            importCsvForm.action = "{{ route('employees.importCsv') }}";
            importCsvForm.enctype = "multipart/form-data";
            importCsvForm.style.display = "none";

            var csrfTokenInput = document.createElement("input");
            csrfTokenInput.type = "hidden";
            csrfTokenInput.name = "_token";
            csrfTokenInput.value = "{{ csrf_token() }}";

            var fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "file";
            fileInput.accept = ".csv";

            var submitButton = document.createElement("button");
            submitButton.type = "submit";
            submitButton.textContent = "Importar";

            importCsvForm.appendChild(csrfTokenInput);
            importCsvForm.appendChild(fileInput);
            importCsvForm.appendChild(submitButton);

            document.body.appendChild(importCsvForm);

            fileInput.addEventListener("change", function () {
                importCsvForm.submit();
            });

            fileInput.click();
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const filterBtn = document.getElementById('filterBtn');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementsByClassName('close')[0];

        if (filterBtn && filterModal && closeModal) {
            filterBtn.onclick = function () {
                filterModal.style.display = 'block';
            }

            closeModal.onclick = function () {
                filterModal.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target === filterModal) {
                    filterModal.style.display = 'none';
                }
            }
        }

        const deleteForm = document.getElementById('multi-delete-form');
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        const deleteModal = document.getElementById('deleteModal');
        const closeModalDelete = deleteModal ? deleteModal.querySelector('.close') : null;
        const confirmDeleteButton = document.getElementById('confirmDelete');
        const cancelDeleteButton = document.getElementById('cancelDelete');

        function collectSelectedIds() {
            // Remove old hidden inputs if any
            const oldInputs = document.querySelectorAll('#multi-delete-form input[type="hidden"][name="selected_ids[]"]');
            oldInputs.forEach(input => input.remove());

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_ids[]';
                    input.value = checkbox.value;
                    deleteForm.appendChild(input);
                }
            });
        }

        if (deleteForm && deleteModal && closeModalDelete && confirmDeleteButton && cancelDeleteButton) {
            const deleteButton = deleteForm.querySelector('button[type="submit"]');

            deleteButton.addEventListener('click', function (event) {
                event.preventDefault();
                collectSelectedIds();
                if (document.querySelectorAll('#multi-delete-form input[type="hidden"][name="selected_ids[]"]').length > 0) {
                    deleteModal.style.display = 'block';
                }
            });

            closeModalDelete.addEventListener('click', function () {
                deleteModal.style.display = 'none';
            });

            cancelDeleteButton.addEventListener('click', function () {
                deleteModal.style.display = 'none';
            });

            confirmDeleteButton.addEventListener('click', function () {
                deleteForm.submit();
            });

            window.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        }

        const rows = document.querySelectorAll('.list-table tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function (event) {
                if (event.target.type === 'checkbox') {
                    event.stopPropagation();
                } else {
                    if (row.dataset.url) {
                        window.location = row.dataset.url;
                    }
                }
            });
        });
    });
</script>

document.addEventListener('DOMContentLoaded', function() {
    // Função para mostrar e esconder o modal de filtros
    const filterBtn = document.getElementById('filterBtn');
    const filterModal = document.getElementById('filterModal');
    const closeModal = document.getElementsByClassName('close')[0];

    if (filterBtn && filterModal && closeModal) {
        filterBtn.onclick = function() {
            filterModal.style.display = 'block';
        };

        closeModal.onclick = function() {
            filterModal.style.display = 'none';
        };

        window.addEventListener('click', function(event) {
            if (event.target === filterModal) {
                filterModal.style.display = 'none';
            }
        });
    }

    // Configuração do modal de confirmação de exclusão
    const deleteModal = document.getElementById('deleteModal');
    const closeModalDelete = deleteModal ? deleteModal.querySelector('.close') : null;
    const confirmDeleteButton = document.getElementById('confirmDelete');
    const cancelDeleteButton = document.getElementById('cancelDelete');
    let formToDelete = null;

    if (deleteModal && closeModalDelete && confirmDeleteButton && cancelDeleteButton) {
        // Exclusão múltipla
        const deleteForm = document.getElementById('multi-delete-form');
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        const deleteButton = deleteForm.querySelector('button[type="submit"]');

        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();
            collectSelectedIds();
            if (document.querySelectorAll('#multi-delete-form input[type="hidden"][name="selected_ids[]"]').length > 0) {
                formToDelete = deleteForm;
                deleteModal.style.display = 'block';
            }
        });

        function collectSelectedIds() {
            // Remover inputs escondidos antigos, se houver
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

        // Exclusão individual
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const employeeId = this.getAttribute('data-id');
                formToDelete = document.getElementById(`delete-form-${employeeId}`);
                deleteModal.style.display = 'block';
            });
        });

        closeModalDelete.onclick = function() {
            deleteModal.style.display = 'none';
        };

        confirmDeleteButton.onclick = function() {
            if (formToDelete) {
                formToDelete.submit();
            }
        };

        cancelDeleteButton.onclick = function() {
            deleteModal.style.display = 'none';
        };

        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });
    }

    // Mostrar/Esconder formulário de exclusão múltipla baseado na seleção de checkboxes
    const multiDeleteForm = document.getElementById('multi-delete-form');
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');

    function toggleDeleteForm() {
        const selectedCount = document.querySelectorAll('input[name="selected_ids[]"]:checked').length;
        multiDeleteForm.style.display = selectedCount > 0 ? 'inline-block' : 'none';
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteForm);
    });

    // Verificação inicial ao carregar a página
    toggleDeleteForm();

    // Configuração para o botão de adicionar e suas opções
    const addButton = document.getElementById('addButton');
    const addOptions = document.getElementById('addOptions');
    const importCsvBtn = document.getElementById('importCsvBtn');

    if (addButton && addOptions && importCsvBtn) {
        addButton.onclick = function() {
            addOptions.style.display = addOptions.style.display === 'block' ? 'none' : 'block';
        };

        importCsvBtn.onclick = function(event) {
            event.preventDefault();

            const importCsvForm = document.createElement('form');
            importCsvForm.method = 'POST';
            importCsvForm.action = importCsvBtn.getAttribute('data-action');
            importCsvForm.enctype = 'multipart/form-data';
            importCsvForm.style.display = 'none';

            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = importCsvBtn.getAttribute('data-token');

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'file';
            fileInput.accept = '.csv';

            const submitButton = document.createElement('button');
            submitButton.type = 'submit';
            submitButton.textContent = 'Importar';

            importCsvForm.appendChild(csrfTokenInput);
            importCsvForm.appendChild(fileInput);
            importCsvForm.appendChild(submitButton);

            document.body.appendChild(importCsvForm);

            fileInput.click();

            fileInput.addEventListener('change', function() {
                importCsvForm.submit();
            });
        };
    }

    const pageBack = document.getElementById('pageBack');
    if (pageBack) {
        pageBack.onclick = function() {
            console.log("Page Back button clicked");
            window.history.back();
        };
    }

});

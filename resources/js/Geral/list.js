document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.getElementById('filterBtn');
    const filterModal = document.getElementById('filterModal');
    const closeModal = document.getElementsByClassName('close')[0];

    if (filterBtn && filterModal && closeModal) {
        filterBtn.onclick = function() {
            filterModal.style.display = 'block';
        }

        closeModal.onclick = function() {
            filterModal.style.display = 'none';
        }

        window.addEventListener('click', function(event) {
            if (event.target === filterModal) {
                filterModal.style.display = 'none';
            }
        });
    }

    const deleteModal = document.getElementById('deleteModal');
    const closeModalDelete = deleteModal ? deleteModal.querySelector('.close') : null;
    const confirmDeleteButton = document.getElementById('confirmDelete');
    const cancelDeleteButton = document.getElementById('cancelDelete');
    let formToDelete = null;

    if (deleteModal && closeModalDelete && confirmDeleteButton && cancelDeleteButton) {
        // Multiple delete
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

        // Individual delete
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tripId = this.getAttribute('data-id');
                formToDelete = document.getElementById(`delete-form-${tripId}`);
                deleteModal.style.display = 'block';
            });
        });

        closeModalDelete.onclick = function() {
            deleteModal.style.display = 'none';
        }

        confirmDeleteButton.onclick = function() {
            if (formToDelete) {
                formToDelete.submit();
            }
        }

        cancelDeleteButton.onclick = function() {
            deleteModal.style.display = 'none';
        }

        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });
    }

    // Add Button Options
    const addButton = document.getElementById('addButton');
    const addOptions = document.getElementById('addOptions');
    const importCsvBtn = document.getElementById('importCsvBtn');

    if (addButton && addOptions && importCsvBtn) {
        addButton.onclick = function() {
            addOptions.style.display = addOptions.style.display === 'block' ? 'none' : 'block';
        }

        importCsvBtn.onclick = function(event) {
            event.preventDefault();

            const importCsvForm = document.createElement('form');
            importCsvForm.method = 'POST';
            importCsvForm.action = importCsvBtn.getAttribute('data-action'); // Ensure this attribute is correctly set
            importCsvForm.enctype = 'multipart/form-data';
            importCsvForm.style.display = 'none';

            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = importCsvBtn.getAttribute('data-token'); // Ensure this attribute is correctly set

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
        }
    }

    const pageBack = document.getElementById('pageBack');
    if (pageBack) {
        pageBack.onclick = function() {
            window.history.back();
        }
    }
});
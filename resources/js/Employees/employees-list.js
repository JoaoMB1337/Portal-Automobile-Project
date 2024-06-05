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

        window.onclick = function(event) {
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

        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();
            collectSelectedIds();
            if (document.querySelectorAll('#multi-delete-form input[type="hidden"][name="selected_ids[]"]').length > 0) {
                deleteModal.style.display = 'block';
            }
        });

        closeModalDelete.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        cancelDeleteButton.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        confirmDeleteButton.addEventListener('click', function() {
            deleteForm.submit();
        });

        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    }

    const rows = document.querySelectorAll('.list-table tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', function(event) {
            if (event.target.type === 'checkbox') {
                event.stopPropagation();
            } else {
                if (row.dataset.url){
                    window.location = row.dataset.url;
                } 
            }
        });
    });
});

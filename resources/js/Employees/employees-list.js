document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.getElementById('filterBtn');
    const filterModal = document.getElementById('filterModal');
    const closeModal = document.getElementsByClassName('close')[0];

    filterBtn.onclick = function() {
        filterModal.style.display = 'block';
    }

    closeModal.onclick = function() {
        filterModal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == filterModal) {
            filterModal.style.display = 'none';
        }
    }

    const deleteForm = document.getElementById('multi-delete-form');
    const selectedIdsField = document.getElementById('selected-ids');
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    const deleteModal = document.getElementById('deleteModal');
    const closeModalDelete = deleteModal.querySelector('.close');
    const confirmDeleteButton = document.getElementById('confirmDelete');
    const cancelDeleteButton = document.getElementById('cancelDelete');

    function collectSelectedIds() {
        let selectedIds = [];
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedIds.push(checkbox.value);
            }
        });
        selectedIdsField.value = selectedIds.join(',');
    }

    const deleteButton = deleteForm.querySelector('button[type="submit"]');
    deleteButton.addEventListener('click', function(event) {
        event.preventDefault();
        collectSelectedIds();
        if (selectedIdsField.value) {
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

    const rows = document.querySelectorAll('.list-table tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', function(event) {
            //  clique foi em uma checkbox
            if (event.target.type === 'checkbox') {
                event.stopPropagation();
            } else {
                //  navega para a página de show
                window.location = row.dataset.url;
            }
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
});

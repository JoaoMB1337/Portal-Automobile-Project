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

    const selectAllCheckbox = document.getElementById('select-all-checkbox');
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    const selectedIdsInput = document.getElementById('selected-ids');
    const deleteButton = document.querySelector('.delete-link');

    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        updateSelectedIds();
        toggleDeleteButton();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            }
            updateSelectedIds();
            toggleDeleteButton();
        });
    });

    function updateSelectedIds() {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);
        selectedIdsInput.value = JSON.stringify(selectedIds);
    }

    function toggleDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        deleteButton.style.display = anyChecked ? 'inline-block' : 'none';
    }

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

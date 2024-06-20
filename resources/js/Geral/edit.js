document.getElementById('add-contact-btn').addEventListener('click', function () {
    var container = document.getElementById('contacts-container');
    var index = container.children.length;
    var newContact = document.createElement('div');
    newContact.className = 'flex mb-2';

    var selectHTML = '<select name="contacts[' + index + '][type]" class="form-select mr-2">';
    window.contactTypes.forEach(function(contactType) {
        selectHTML += '<option value="' + contactType.id + '">' + contactType.type + '</option>';
    });
    selectHTML += '</select>';

    newContact.innerHTML = `
        ${selectHTML}
        <input type="text" name="contacts[${index}][value]" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200">
        <button type="button" class="ml-2 text-red-600 remove-contact-btn">&times;</button>
    `;

    container.appendChild(newContact);
    addRemoveButtonListener(newContact.querySelector('.remove-contact-btn'));
});

function addRemoveButtonListener(button) {
    button.addEventListener('click', function () {
        button.parentElement.remove();
    });
}

document.querySelectorAll('.remove-contact-btn').forEach(addRemoveButtonListener);

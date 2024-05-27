    document.addEventListener("DOMContentLoaded", function () {
    const isExternalCheckbox = document.getElementById("is_external");
    const externalFieldContainer = document.querySelector(".external-field");

    function toggleExternalFields() {
    if (isExternalCheckbox.checked) {
    externalFieldContainer.style.display = "block";
} else {
    externalFieldContainer.style.display = "none";
}
}

    isExternalCheckbox.addEventListener("change", toggleExternalFields);

    toggleExternalFields();
});


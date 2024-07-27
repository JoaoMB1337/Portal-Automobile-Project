document.addEventListener('DOMContentLoaded', function() {
    const pageBack = document.getElementById('pageBack');
    if (pageBack) {
        pageBack.onclick = function() {
            console.log("Page Back button clicked");
            window.history.back();
        };
    } else {
        console.log("Page Back button not found.");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    let params = new URLSearchParams(window.location.search);
    if (params.has("success")) {
        document.getElementById("modal-overlay").style.display = "flex";
    }

    document.getElementById("close-modal").addEventListener("click", function() {
        document.getElementById("modal-overlay").style.display = "none";
        history.replaceState({}, document.title, window.location.pathname);
    });
});
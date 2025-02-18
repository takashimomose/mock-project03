document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    if (params.has("success")) {
        const modalOverlay = document.getElementById("modal-overlay");
        modalOverlay.style.display = "flex";
    }
});
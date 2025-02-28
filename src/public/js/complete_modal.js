document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    if (params.has("success")) {
        const modalOverlay = document.getElementById("modal-overlay");
        modalOverlay.style.display = "flex";

        const closeModalBtn = document.getElementById("close-modal");

        closeModalBtn.addEventListener("click", function () {
            modalOverlay.style.display = "none";

            const url = window.location.href.split('?')[0];
            window.history.replaceState(null, '', url);
        });
    }
});

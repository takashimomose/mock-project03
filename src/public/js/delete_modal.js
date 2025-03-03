document.addEventListener("DOMContentLoaded", function () {
    const deleteBtns = document.querySelectorAll(".delete-btn");
    const modalOverlay = document.getElementById("delete-modal-overlay");
    const confirmDeleteBtn = document.getElementById("confirm-delete-btn");
    const cancelDeleteBtn = document.getElementById("cancel-delete-btn");
    let shopIdToDelete = null;

    deleteBtns.forEach(button => {
        button.addEventListener("click", function () {
            shopIdToDelete = this.getAttribute("data-shop-id");
            modalOverlay.style.display = "flex"; // モーダルを表示
        });
    });

    confirmDeleteBtn.addEventListener("click", function () {
        if (shopIdToDelete) {
                    console.log(shopIdToDelete);

            fetch(`/owner/shop/delete/${shopIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    console.log(response); 
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('削除に失敗しました');
                    }
                });
        }
    });

    cancelDeleteBtn.addEventListener("click", function () {
        modalOverlay.style.display = "none";
    });
});
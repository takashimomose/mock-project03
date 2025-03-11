document.addEventListener("DOMContentLoaded", function () {
    const ratingBtns = document.querySelectorAll(".rating-btn");
    const modalOverlay = document.getElementById("rating-modal-overlay");
    const ratingInput = document.getElementById("ratingValue");
    const commentTextarea = document.getElementById("commentTextarea");
    const confirmEditBtn = document.getElementById("confirm-rating-btn");
    const cancelEditBtn = document.getElementById("cancel-rating-btn");

    let ratingReservationId = null;
    let ratingUserId = null;
    let ratingShopId = null;

    ratingBtns.forEach(button => {
        button.addEventListener("click", function () {
            ratingReservationId = this.getAttribute("data-rating-reservation-id");
            ratingUserId = this.getAttribute("data-rating-user-id");
            ratingShopId = this.getAttribute("data-rating-shop-id");

            modalOverlay.style.display = "flex";

        });
    });

    confirmEditBtn.addEventListener("click", function () {
        const inputRating = ratingInput.value;
        const inputComment = commentTextarea.value;

        fetch(`/${ratingShopId}/store`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                user_id: ratingUserId,
                shop_id: ratingShopId,
                reservation_id: ratingReservationId,
                rating: inputRating,
                comment: inputComment
            })
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    if (data.errors) {
                        displayValidationErrors(data.errors); // フォームにエラーメッセージを表示
                    } else {
                        alert('作成に失敗しました');
                    }
                } else {
                    window.location.reload();
                }
            })
            .catch(error => {
                alert("エラーが発生しました");
            });

        // フォームのエラーメッセージを表示する関数
        function displayValidationErrors(errors) {
            document.querySelectorAll(".error-message").forEach(el => el.innerHTML = "");

            Object.keys(errors).forEach(field => {
                const errorElement = document.querySelector(`#${field}Error`);
                if (errorElement) {
                    errorElement.innerHTML = errors[field].join('<br>'); // 複数エラー対応
                }
            });
        }

    });

    cancelEditBtn.addEventListener("click", function () {
        const ratingInput = document.getElementById("ratingValue");
        const commentTextarea = document.getElementById("commentTextarea");

        // 入力値をリセット
        ratingInput.value = ratingInput.dataset.default;
        commentTextarea.value = commentTextarea.dataset.default;

        // 星の表示をリセット
        updateStars();

        document.getElementById("rating-value").textContent = "0";  // ここで表示も0にリセット

        // バリデーションエラーメッセージを削除
        document.querySelectorAll(".error-message").forEach(error => error.textContent = "");

        // モーダルを非表示
        modalOverlay.style.display = "none";
    });

    // 星を更新する関数
    function updateStars() {
        document.querySelectorAll(".star").forEach((star) => {
            star.classList.remove("selected");  // すべての星の選択状態を解除
        });
    }    
});
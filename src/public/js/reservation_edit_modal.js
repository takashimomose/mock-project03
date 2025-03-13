document.addEventListener("DOMContentLoaded", function () {
    const editBtns = document.querySelectorAll(".edit-btn");
    const modalOverlay = document.getElementById("edit-modal-overlay");
    const dateInput = document.getElementById("dateInput");
    const timeSelect = document.getElementById("timeSelect");
    const peopleSelect = document.getElementById("peopleSelect");
    const confirmEditBtn = document.getElementById("confirm-edit-btn");
    const cancelEditBtn = document.getElementById("cancel-edit-btn");

    let reservationId = null;
    let reservationUserId = null;

    editBtns.forEach(button => {
        button.addEventListener("click", function () {
            reservationId = this.getAttribute("data-reservation-id");
            reservationUserId = this.getAttribute("data-reservation-user-id");

            modalOverlay.style.display = "flex";
            dateInput.value = this.getAttribute("data-reservation-date");
            timeSelect.value = this.getAttribute("data-reservation-time");
            peopleSelect.value = this.getAttribute("data-reservation-people");
        });
    });

    confirmEditBtn.addEventListener("click", function () {
        const updatedDate = dateInput.value;
        const updatedTime = timeSelect.value;
        const updatedPeople = peopleSelect.value;

        fetch(`/reserve/update/${reservationId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                date: updatedDate,
                time: updatedTime,
                people: updatedPeople
            })
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    if (data.errors) {
                        displayValidationErrors(data.errors);
                    } else {
                        alert('更新に失敗しました');
                    }
                } else {
                    window.location.reload();
                }
            })
            .catch(error => {
                alert("エラーが発生しました");
            });

        function displayValidationErrors(errors) {
            document.querySelectorAll(".error-message").forEach(el => el.innerHTML = "");

            Object.keys(errors).forEach(field => {
                const errorElement = document.querySelector(`#${field}Error`);
                if (errorElement) {
                    errorElement.innerHTML = errors[field].join('<br>');
                }
            });
        }

    });
    cancelEditBtn.addEventListener("click", function () {

        document.getElementById("dateInput").value = document.getElementById("dateInput").dataset.default;
        document.getElementById("timeSelect").value = document.getElementById("timeSelect").dataset.default;
        document.getElementById("peopleSelect").value = document.getElementById("peopleSelect").dataset.default;

        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach(function (error) {
            error.textContent = "";
        });

        modalOverlay.style.display = "none";
    });
});
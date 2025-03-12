document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingValueDisplay = document.getElementById("rating-value");
    const ratingInput = document.getElementById("ratingValue"); 

    stars.forEach(star => {
        star.addEventListener("click", function () {
            const value = parseInt(this.getAttribute("data-value"));
            setRating(value);
        });
    });

    stars.forEach(star => {
        star.addEventListener("mouseover", function () {
            const value = parseInt(this.getAttribute("data-value"));
            highlightStars(value);
        });
        star.addEventListener("mouseleave", function () {
            const currentRating = parseInt(ratingValueDisplay.textContent);
            highlightStars(currentRating);
        });
    });

    function setRating(value) {
        ratingValueDisplay.textContent = value;
        ratingInput.value = value;
        highlightStars(value);
    }

    function highlightStars(value) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute("data-value")) <= value) {
                star.classList.add("selected");
            } else {
                star.classList.remove("selected");
            }
        });
    }
});

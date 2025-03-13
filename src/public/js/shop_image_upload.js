document.getElementById('shop-image').addEventListener('change', function(event) {
    let fileInput = event.target;

    if (!fileInput.files.length) {
        return;
    }

    let file = fileInput.files[0];
    let allowedTypes = ['image/jpeg', 'image/png'];
    let fileType = file.type;

    if (!allowedTypes.includes(fileType)) {
        alert("JPGまたはPNG形式の画像ファイルをアップロードしてください。");
        fileInput.value = "";
        return;
    }

    let formData = new FormData();
    formData.append('shop_image', event.target.files[0]);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    fetch("/owner/shop/upload-temp-image", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('preview').src = data.image_url;
                document.getElementById('preview').style.display = 'block';
                document.getElementById('delete-btn').style.display = 'block';
                document.querySelector('.image-preview').style.display = 'flex';
                fileInput.value = "";
            }
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById("delete-btn").addEventListener("click", function() {
    fetch("/owner/shop/delete-temp-image", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("preview").style.display = "none";
                document.getElementById('delete-btn').style.display = 'none';
                document.querySelector('.image-preview').style.display = 'none';
            }
        })
        .catch(error => console.error("Error:", error));
});

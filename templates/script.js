// Function to show custom alert
function showCustomAlert(situation, notice) {
    const alertBox = document.getElementById('custom-alert');

    // Cập nhật nội dung thông báo
    alertBox.textContent = notice;

    // Xóa các class cũ để đảm bảo hiệu ứng mới hoạt động
    alertBox.classList.remove('hide');
    alertBox.classList.add('show');

    // Xử lý màu sắc dựa trên tình huống
    if (situation === 'success') {
        alertBox.style.backgroundColor = '#4caf50'; // Màu xanh lá cho thành công
    } else if (situation === 'fail') {
        alertBox.style.backgroundColor = '#f44336'; // Màu đỏ cho thất bại
    } else {
        alertBox.style.backgroundColor = '#007bff'; // Màu mặc định (xanh dương) cho thông báo khác
    }

    // Sau 3 giây, bắt đầu hiệu ứng kéo lên
    setTimeout(() => {
        alertBox.classList.remove('show');
        alertBox.classList.add('hide');
    }, 3500); // Thời gian hiển thị alert (3 giây)
}

document.addEventListener("DOMContentLoaded", function () {
    const uploadImageInput = document.getElementById("upload-image");
    const imagePreview = document.getElementById("image-preview");
    const previewImg = document.getElementById("preview-img");
    const uploadButton = document.querySelector(".upload-button");
    const removeImageButton = document.getElementById("remove-image");

    // Khi nhấn vào nút SVG, kích hoạt input file
    uploadButton.addEventListener("click", (event) => {
         uploadImageInput.click(); // Mở file input
    });

    // Hiển thị ảnh xem trước khi người dùng chọn file
    uploadImageInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result; // Hiển thị ảnh chính
                imagePreview.style.display = "block"; // Hiển thị phần preview
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = "#";
            imagePreview.style.display = "none"; // Ẩn phần preview nếu không có ảnh
        }
    });

    // Khi nhấn nút "x", xóa ảnh và ẩn preview
    removeImageButton.addEventListener("click", function () {
        previewImg.src = "#";
        imagePreview.style.display = "none"; // Ẩn phần preview khi xóa ảnh
        uploadImageInput.value = ""; // Reset input file
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const pop_uploadImageInput = document.getElementById("pop-upload-image");
    const pop_imagePreview = document.getElementById("pop-image-preview");
    const pop_previewImg = document.getElementById("pop-preview-img");
    const pop_uploadButton = document.querySelector(".pop-upload-button");
    const pop_removeImageButton = document.getElementById("pop-remove-image");

    // Khi nhấn vào nút SVG, kích hoạt input file
    pop_uploadButton.addEventListener("click", () => {
        pop_uploadImageInput.click();
    });

    // Hiển thị ảnh xem trước khi người dùng chọn file
    pop_uploadImageInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                pop_previewImg.src = e.target.result;
                pop_imagePreview.style.display = "block"; // Hiển thị phần preview
            };
            reader.readAsDataURL(file);
        } else {
            pop_previewImg.src = "#";
            pop_imagePreview.style.display = "none"; // Ẩn phần preview nếu không có ảnh
        }
    });

    // Khi nhấn nút "x", xóa ảnh và ẩn preview
    pop_removeImageButton.addEventListener("click", function () {
        pop_previewImg.src = "#";
        pop_imagePreview.style.display = "none"; // Ẩn phần preview khi xóa ảnh
        pop_uploadImageInput.value = ""; // Reset input file
    });
});

// document.addEventListener("input", function (event) {
//     if (event.target.tagName.toLowerCase() === "textarea") {
//         event.target.style.height = "auto"; // Đặt chiều cao về auto
//         event.target.style.height = (event.target.scrollHeight) + "px"; // Cập nhật chiều cao theo chiều cao nội dung
//     }
// });


// function check_space(...fields) {
//     for (let i = 0; i < fields.length; i++) {
//         const fieldValue = document.getElementsByName(fields[i])[0].value.trim();
//         if (!fieldValue) {
//             alert('Please fill in all fields.');
//             return false;
//         }
//     }
//     return true;
// }

// function check_space(username, usertag, email, gender, dob) {
//     const username_c = (document.getElementsByName(username)[0].value).trim();
//     const usertag_c = (document.getElementsByName(usertag)[0].value).trim();
//     const email_c = (document.getElementsByName(email)[0].value).trim();
//     const gender_c = (document.getElementsByName(gender)[0].value).trim();
//     const dob_c = (document.getElementsByName(dob)[0].value).trim();

//     if (!username_c || !usertag_c || !email_c || !gender_c || !dob_c) {
//         alert('Please fill in all fields.');
//         return false;
//     }
//     return true
// }
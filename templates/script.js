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

// 1. Xử lý xóa ảnh cũ
document.getElementById("delete-old-image-btn").addEventListener("click", function () {
    const oldImagePathInput = document.getElementById("old-image-path");
    const deleteExistingImageInput = document.getElementById("delete-existing-image");

    // Đặt giá trị input hidden thành 1 để đánh dấu xóa ảnh cũ
    deleteExistingImageInput.value = "1";

    // Làm trống input của đường dẫn ảnh cũ
    oldImagePathInput.value = "No image available"; // Thay thế nội dung của trường ảnh cũ
    oldImagePathInput.setAttribute("readonly", true); // Chỉ đọc
    oldImagePathInput.classList.add("text-muted"); // Thêm class để làm xám văn bản
});

// 2. Xử lý xóa ảnh mới
document.getElementById("delete-new-image-btn").addEventListener("click", function () {
    const newImagePathInput = document.getElementById("new-image-path");

    // Làm trống trường input file để người dùng có thể chọn lại
    newImagePathInput.value = ""; // Xóa giá trị của input file
});

// 3. Khi người dùng chọn ảnh mới, kiểm tra sự kiện change
document.getElementById("new-image-path").addEventListener("change", function () {
    if (this.files && this.files.length > 0) {
        console.log("File đã chọn:", this.files[0].name);
    }
});


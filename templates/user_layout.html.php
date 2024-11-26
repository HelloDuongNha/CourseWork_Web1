<?php
// Hiển thị thông báo nếu có lỗi từ session
if (isset($_SESSION['error_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('fail', '" . $_SESSION['error_message'] . "');
            }
        </script>";
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('success', '" . $_SESSION['success_message'] . "');
            }
        </script>";
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../templates/user.css?version=4">
    <title> <?= $title ?> </title>
    <script>
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

        document.addEventListener("DOMContentLoaded", function() {
            const uploadImageInput = document.getElementById("upload-image");
            const imagePreview = document.getElementById("image-preview");
            const previewImg = document.getElementById("preview-img");
            const uploadButton = document.querySelector(".upload-button");
            const removeImageButton = document.getElementById("remove-image");

            
            // Khi nhấn vào nút SVG, kích hoạt input file
            uploadButton.addEventListener("click", () => {
                uploadImageInput.click();
            });

            // Hiển thị ảnh xem trước khi người dùng chọn file
            uploadImageInput.addEventListener("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.style.display = "block"; // Hiển thị phần preview
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImg.src = "#";
                    imagePreview.style.display = "none"; // Ẩn phần preview nếu không có ảnh
                }
            });

            // Khi nhấn nút "x", xóa ảnh và ẩn preview
            removeImageButton.addEventListener("click", function() {
                previewImg.src = "#";
                imagePreview.style.display = "none"; // Ẩn phần preview khi xóa ảnh
                uploadImageInput.value = ""; // Reset input file
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
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
            pop_uploadImageInput.addEventListener("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
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
            pop_removeImageButton.addEventListener("click", function() {
                pop_previewImg.src = "#";
                pop_imagePreview.style.display = "none"; // Ẩn phần preview khi xóa ảnh
                pop_uploadImageInput.value = ""; // Reset input file
            });
        });

        document.addEventListener("input", function(event) {
            if (event.target.tagName.toLowerCase() === "textarea") {
                event.target.style.height = "auto"; // Đặt chiều cao về auto
                event.target.style.height = (event.target.scrollHeight) + "px"; // Cập nhật chiều cao theo chiều cao nội dung
            }
        });
    </script>



</head>

<body>
    <div id="custom-alert" class="alert alert-success" role="alert">Đây là thông báo tùy chỉnh với hiệu ứng rơi xuống và kéo lên!</div>
    <!-- Sidebar trái -->
    <aside class="aside-left">
        <div class="logo">
            <a href="">
                <img src="../images/2022-Greenwich-White-Eng.png" alt="Logo">
            </a>
        </div>

        <div class="menu">
            <nav>
                <ul>
                    <li class="menu-item">
                        <!-- <img src="../images/home.svg" alt="Home"> -->
                        <a class="btn btn-outline-light" href="../Homepage/homepage.php"> <img src="../images/home.svg" alt="Home">Homepage</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/profile.svg" alt="profile"> -->
                        <a class="btn btn-outline-light" href=""> <img src="../images/profile.svg" alt="profile">My profile</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/bookmark.svg" alt="bookmark"> -->
                        <a class="btn btn-outline-light" href=""> <img src="../images/bookmark.svg" alt="bookmark">Bookmarks</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/admin.svg" alt="admin"> -->
                        <a class="btn btn-outline-light" href=""> <img src="../images/admin.svg" alt="admin">Admin</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/contact.svg" alt="contact"> -->
                        <a class="btn btn-outline-light" href=""><img src="../images/contact.svg" alt="contact">Contact us</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/create_acc.svg" alt="register"> -->
                        <a class="btn btn-outline-light" href=""> <img src="../images/create_acc.svg" alt="register">Register Account</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/Setting.svg" alt="setting"> -->
                        <a class="btn btn-outline-light" href=""><img src="../images/Setting.svg" alt="setting">Settings</a>
                    </li>
                    <li class="menu-item">
                        <!-- <img src="../images/logout.svg" alt="logout"> -->
                        <a class="btn btn-outline-light" href="../Log in/logout.php"><img src="../images/logout.svg" alt="logout">Logout</a>
                    </li>
                    <li class="menu-item extend-list">
                        <!-- <img src="../images/create.svg" alt="create"> -->
                        <a class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#postModal">
                            <img src="../images/create.svg" alt="create"> Create new post
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a class="account setting" href="">
                            <img src="../images/profile.svg" alt="avatar">
                            <p> <?= $_SESSION['user_id'] ?></p>
                        </a>
                    </li>
                </ul>
            </nav>
    </aside>


    <!-- Modal -->
    <div class="modal fade" id="postModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="post-avatar" src="../images/profile.svg" alt="Avatar">
                    <h1 class="modal-title fs-5" id="postModalLabel"><?= $_SESSION['username'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="../Create_Post/create_post.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating">
                            <textarea class="form-control create-caption" placeholder="What are you thinking about?" name="post_caption" style="height: 80px;" required></textarea>
                            <label style="color: #000;" for="floatingPostCaption">What are you thinking about?</label>
                        </div>
                        <!-- Preview ảnh khi đã chọn -->
                        <div id="pop-image-preview" style="display: none; position: relative; text-align: center;">
                            <div class="image-background">
                                <img id="pop-preview-img" src="#" alt="Image Preview">
                            </div>
                            <button class="btn btn-outline-danger" id="pop-remove-image" type="button">&times;</button>
                        </div> 
                        <div class="post-footer">                    
                            <!-- Nút SVG thay thế cho input file -->
                            <div class="pop-upload-button input-group mb-3" style="display: flex; align-items: left; cursor: pointer;">
                                <img src="../images/add-image.svg" alt="Upload Image" width="32" height="32" style="cursor: pointer;">
                                <span style="margin-left: 8px;">Upload Image</span>
                                <input type="file" name="post_image" id="pop-upload-image" accept="image/*" style="display: none;">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="create_post" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung chính -->
    <div class="container">
        <main class="content">
            <?= $output ?>
        </main>
    </div>

    <!-- Sidebar phải -->
    <aside class="aside-right">
        <div class="search-container">
            <input type="text" placeholder="Search" />
        </div>

        <div class="other-user">
            <h2>Other user:</h2>
            <nav>
                <ul>
                    <?php
                    include '../includes/DatabaseConnection.php';
                    include_once '../includes/Functions.php';
                    $users = GetAllUser($pdo);
                    foreach ($users as $user): ?>
                        <li class="menu-item right-sidebar">
                            <img style="height: 30px; width: 30px;" src="../images/profile.svg" alt="avatar">
                            <p>@<?= $user['user_tag'] ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
    </aside>

    <!-- Footer -->
    <footer>Đây là footer</footer>

</body>

</html>
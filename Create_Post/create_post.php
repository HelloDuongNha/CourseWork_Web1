<?php
session_start();
$title = "Create Post";
ob_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['create_post'])) {
    $post_caption = $_POST["post_caption"];
    $user_id = $_SESSION["user_id"];
    $post_created_day = date('Y-m-d'); // Giữ lại ngày (nếu cần cho cột cũ)
    $post_created_time = date('H:i:s'); // Lấy giờ
    
    $last_modified = $post_created_datetime;

    // Kiểm tra và xử lý ảnh
    $image_path = NULL; // Mặc định là NULL nếu không có ảnh
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === 0) {
        $upload_dir = '../uploaded_imgs/';
        $filename = basename($_FILES['post_image']['name']);
        $target_path = $upload_dir . $filename;

        // Lưu file vào thư mục
        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $target_path)) {
            // Lưu đường dẫn tương đối để sử dụng trong <img src="">
            $image_path = $target_path;
        }
    }

    // Chuẩn bị câu lệnh SQL để chèn vào bảng posts
    $query = "
        INSERT INTO posts (
            post_caption,
            post_created_day,
            post_created_time,
            post_last_modified,
            user_id,
            img_path,
            repost_check,
            repost_date,
            repost_caption,
            repost_user_tag,
            repost_user_name
        ) VALUES (
            :post_caption,
            :post_created_day,
            :post_created_time,
            :post_last_modified,
            :user_id,
            :img_path,
            0,
            NULL,
            NULL,
            NULL,
            NULL
        )
    ";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_caption", $post_caption);
    $statement->bindValue(":post_created_day", $post_created_day);
    $statement->bindValue(":post_created_time", $post_created_time);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":user_id", $user_id);
    $statement->bindValue(":img_path", $image_path); // Gán đường dẫn ảnh (hoặc NULL)

    $statement->execute();

    // Điều hướng sau khi tạo bài viết
    header("location: ../Homepage/homepage.php");
}
$output = ob_get_clean();
include '../templates/user_layout.html.php';
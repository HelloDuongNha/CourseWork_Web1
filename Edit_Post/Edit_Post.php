<?php
session_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id']; // Lấy ID bài viết cần chỉnh sửa
    $post_caption = trim($_POST["post_caption"]); // Lấy caption
    $post_caption = htmlspecialchars($post_caption, ENT_QUOTES, 'UTF-8'); // Mã hóa ký tự đặc biệt

    if (empty($post_caption)) {
        $_SESSION['error_message'] = 'Post caption cannot be empty!';
        header('Location: ../Homepage/homepage.php');
        exit();
    }


    if (!isset($_POST['module_id']) || empty($_POST['module_id'])) {
        $_SESSION['error_message'] = 'Please select a module!';
        header('Location: ../Homepage/homepage.php');
        exit();
    }
    $module_id = $_POST['module_id'];

    $last_modified = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

    // Lấy đường dẫn ảnh hiện tại của bài viết từ CSDL
    $query = "SELECT img_path FROM posts WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();
    $old_image_path = $statement->fetchColumn();

    // Kiểm tra xem người dùng có yêu cầu xóa ảnh cũ hay không
    $delete_old_image = isset($_POST['delete_existing_image']) && $_POST['delete_existing_image'] === '1';

    // Kiểm tra xem người dùng có upload ảnh mới hay không
    $new_image_path = CheckUploadImage($_FILES['new_post_image'], '../images/uploaded_imgs/'); // Hàm này trả về đường dẫn ảnh mới nếu upload thành công, nếu không thì trả về NULL

    // Xóa ảnh cũ nếu người dùng yêu cầu xóa ảnh cũ
    if ($delete_old_image && !empty($old_image_path)) {
        $old_image_full_path = "../uploaded_imgs/" . $old_image_path;
        if (file_exists($old_image_full_path)) {
            unlink($old_image_full_path); 
        }
        $old_image_path = NULL; // Đặt ảnh cũ về NULL
    }

    // Xác định ảnh nào sẽ được sử dụng
    if (!empty($new_image_path)) {
        // Trường hợp người dùng upload ảnh mới
        $image_path = $new_image_path;
    } elseif ($delete_old_image) {
        // Trường hợp người dùng xóa ảnh cũ và không upload ảnh mới
        $image_path = NULL;
    } else {
        // Giữ ảnh cũ nếu không có thay đổi nào
        $image_path = $old_image_path;
    }

    // Cập nhật bài viết
    $query = "
        UPDATE posts 
        SET 
            post_caption = :post_caption, 
            post_last_modified = :post_last_modified, 
            module_id = :module_id, 
            img_path = :img_path 
        WHERE 
            post_id = :post_id
    ";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_caption", $post_caption);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":module_id", $module_id);
    $statement->bindValue(":img_path", $image_path);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();

    // Cập nhật bài viết repost
    $query = "
        UPDATE posts 
        SET 
            post_caption = :post_caption, 
            post_last_modified = :post_last_modified, 
            module_id = :module_id, 
            img_path = :img_path 
        WHERE 
            original_post_id = :post_id and repost_check = 1
    ";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_caption", $post_caption);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":module_id", $module_id);
    $statement->bindValue(":img_path", $image_path);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();


    $_SESSION['success_message'] = 'Post updated successfully!';
    header("Location:" . $_SESSION['last_link']);
    exit();
}

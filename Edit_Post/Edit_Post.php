<?php
session_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id']; 
    $post_caption = trim($_POST["post_caption"]); 
    $post_caption = htmlspecialchars($post_caption, ENT_QUOTES, 'UTF-8'); 

    if (empty($post_caption)) {
        $_SESSION['error_message'] = 'Post caption cannot be empty!';
        header('Location:' . $_SESSION['last_link']);
        exit();
    }


    if (!isset($_POST['module_id']) || empty($_POST['module_id'])) {
        $_SESSION['error_message'] = 'Please select a module!';
        header('Location:' . $_SESSION['last_link']);
        exit();
    }
    $module_id = $_POST['module_id'];
    $last_modified = date('Y-m-d H:i:s');

    $query = "SELECT img_path FROM posts WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();
    $old_image_path = $statement->fetchColumn();

    // check if user delete old img or not?
    $delete_old_image = isset($_POST['delete_existing_image']) && $_POST['delete_existing_image'] === '1';

    // check if user upd new img or not?
    $new_image_path = CheckUploadImage($_FILES['new_post_image'], '../images/uploaded_imgs/');

    // delete old img if user choose delete old img
    if ($delete_old_image && !empty($old_image_path)) {
        $old_image_full_path = "../images/uploaded_imgs/" . $old_image_path;
        if (file_exists($old_image_full_path)) {
            unlink($old_image_full_path); 
        }
        $old_image_path = NULL; 
    }

    if (!empty($new_image_path)) {
        $image_path = $new_image_path;
    } elseif ($delete_old_image) {
        $image_path = NULL;
    } else {
        $image_path = $old_image_path;
    }

    // update post sql
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

    // update post
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

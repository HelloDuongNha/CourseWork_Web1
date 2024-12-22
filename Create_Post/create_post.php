<?php
session_start();
$title = "Create Post";
ob_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['create_post'])) {
    $post_caption = trim($_POST["post_caption"]); 
    $post_caption = htmlspecialchars($post_caption, ENT_QUOTES, 'UTF-8'); 

    if (empty($post_caption)) {
        $_SESSION['error_message'] = 'Post caption cannot be empty!';
        header('location:' . $_SESSION['last_link']);
        exit();
    }
    
    $user_id = $_SESSION["user_id"];
    $post_created_day = date('Y-m-d');
    $post_created_time = date('H:i:s'); 
    $module = $_POST['module_id'];
    $last_modified = $post_created_day . ' ' . $post_created_time; 

    $image_path = CheckUploadImage($_FILES['post_image'], '../images/uploaded_imgs/');
    
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
        module_id
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
        :module
    )
";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_caption", $post_caption);
    $statement->bindValue(":post_created_day", $post_created_day);
    $statement->bindValue(":post_created_time", $post_created_time);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":user_id", $user_id);
    $statement->bindValue(":img_path", $image_path); 
    $statement->bindValue(":module", $module);

    $statement->execute();
    $_SESSION['success_message'] = '+1 post';
    header("Location:" . $_SESSION['last_link']);
    exit();
}
$output = ob_get_clean();
include '../templates/user_layout.html.php';
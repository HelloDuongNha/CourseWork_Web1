<?php
session_start();
require "../Log in/check.php";
$title = "Create Post";
ob_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['create_post'])) {
    $repost_caption = trim($_POST["repost_caption"]); 
    $repost_caption = htmlspecialchars($repost_caption, ENT_QUOTES, 'UTF-8'); 

    if (empty($repost_caption)) {
        $_SESSION['error_message'] = 'Post caption cannot be empty!';
        header('location:' . $_SESSION['last_link']); 
        exit();
    }
    
    // get post info
    $main_user_tag = $_POST['main_user_tag'];
    $main_user_id = getUserIdByTag($pdo, $main_user_tag);
    $post_id = $_POST['post_id'];
    $post_caption = $_POST['post_caption'];
    $post_created_day = $_POST["post_created_day"];
    $post_created_time = $_POST['post_created_time'];
    $repost_user_id = $_POST['repost_user_id'];
    $post_img = $_POST['post_img'];
    $post_module_name = $_POST['post_module_name'];
    $post_module_id = getModuleIdByName($pdo, $post_module_name);

    // get repost info
    $repost_module_id = $_POST['repost_module_id'];
    $repost_caption = $_POST['repost_caption'];
    $repost_user_id = $_POST["repost_user_id"];
    $repost_created_day = date('Y-m-d'); 
    $repost_created_time = date('H:i:s');
    $last_modified = $post_created_day ; 


    // SQL 
    $query = "
    INSERT INTO posts (
        post_caption,
        post_created_day,
        post_created_time,
        post_last_modified,
        user_id,
        repost_check,
        original_post_id,
        repost_user_id,
        repost_date,
        repost_time,
        repost_caption,
        img_path,
        repost_module_id,        
        module_id
    ) VALUES (
        :post_caption,
        :post_created_day,
        :post_created_time,
        :post_last_modified,
        :user_id,
        1,  
        :original_post_id,
        :repost_user_id,
        :repost_date,
        :repost_time,
        :repost_caption,
        :img_path,
        :repost_module_id,
        :module_id
    )
";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":post_caption", $post_caption);
    $statement->bindValue(":post_created_day", $post_created_day);
    $statement->bindValue(":post_created_time", $post_created_time);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":user_id", $main_user_id);
    $statement->bindValue(":original_post_id", $post_id); 
    $statement->bindValue(":repost_user_id", $repost_user_id);
    $statement->bindValue(":repost_date", $repost_created_day); 
    $statement->bindValue(":repost_time", $repost_time); 
    $statement->bindValue(":repost_caption", $repost_caption);
    $statement->bindValue(":img_path", $post_img);
    $statement->bindValue(":repost_module_id", $repost_module_id);
    $statement->bindValue(":module_id", $post_module_id);

    $statement->execute();
    $_SESSION['success_message'] = '+1 repost!';

    header("Location:" . $_SESSION['last_link']);
    exit();
}
$output = ob_get_clean();
include '../templates/user_layout.html.php';
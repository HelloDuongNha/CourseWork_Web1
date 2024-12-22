<?php
session_start();
include "../includes/DatabaseConnection.php";
include "../includes/Functions.php";

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $repost_caption = trim($_POST["repost_caption"]); 
    $repost_caption = htmlspecialchars($repost_caption, ENT_QUOTES, 'UTF-8');

    if (empty($repost_caption)) {
        $_SESSION['error_message'] = 'Post caption cannot be empty!';
        header('Location:' . $_SESSION['last_link']);
        exit();
    }

    if (!isset($_POST['repost_module_id']) || empty($_POST['repost_module_id'])) {
        $_SESSION['error_message'] = 'Please select a module!';
        header('Location:' . $_SESSION['last_link']);
        exit();
    }
    $repost_module_id = $_POST['repost_module_id'];
    $last_modified = date('Y-m-d H:i:s');

    // update repost
    $query = "
        UPDATE posts 
        SET 
            repost_caption = :repost_caption, 
            post_last_modified = :post_last_modified, 
            repost_module_id = :repost_module_id
        WHERE 
            post_id = :post_id
    ";

    $statement = $pdo->prepare($query);
    $statement->bindValue(":repost_caption", $repost_caption);
    $statement->bindValue(":post_last_modified", $last_modified);
    $statement->bindValue(":repost_module_id", $repost_module_id);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();

    $_SESSION['success_message'] = 'Post updated successfully!';
    header("Location:" . $_SESSION['last_link']);
    exit();
}

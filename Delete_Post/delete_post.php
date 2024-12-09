<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Delete Post");

    $id = $_POST['delete_post_id'];
    $sql = "DELETE FROM posts WHERE post_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    
    if ($statement->execute()) {
        $_SESSION['success_message'] = 'delete post success';
        header("Location:" . $_SESSION['last_link']);
        exit;
    } else {
        $_SESSION['success_message'] = 'can not delete post';
        header("Location:" . $_SESSION['last_link']);
        exit;
    }

?>

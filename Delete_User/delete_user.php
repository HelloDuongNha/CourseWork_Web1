<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Delete user");

$id = $_POST['delete_user_id'];
$sql = "DELETE FROM posts WHERE user_id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(":id", $id);
$statement->execute();

$sql = "DELETE FROM posts WHERE repost_user_id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(":id", $id);
$statement->execute();

$sql = "DELETE FROM users WHERE user_id = :id";
$final = $pdo->prepare($sql);
$final->bindValue(":id", $id);
if ($final->execute()) {
    $_SESSION['success_message'] = "delete user and all user's post success";
    header("Location:" . $_SESSION['last_link']);
    exit;
} else {
    $_SESSION['error_message'] = 'can not delete user';
    header("Location:" . $_SESSION['last_link']);
    exit;
}

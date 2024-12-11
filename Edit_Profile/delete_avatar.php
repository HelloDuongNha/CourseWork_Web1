<?php
// require_once "../includes/check.php";
session_start();
include '../includes/DatabaseConnection.php';
include "../includes/Functions.php";

if (isset($_POST['delete_avt'])) {
    $id = $_POST['user_id'];
    $new_avt_path = "profile.png";
    $old_avt_path = $_POST['old_avt_path'];

    $sql = "UPDATE users
        SET avatar = :avatar
        WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':avatar', $new_avt_path);
    $statement->bindValue(':id', $id);
    $statement->execute();

    if (!empty($old_avt_path) && $old_avt_path != "profile.png") {
        $old_avt_full_path = "../images/avatar/" . $old_avt_path;
        if (file_exists($old_avt_full_path)) {
            unlink($old_avt_full_path);
            $_SESSION['success_message'] = "delete avt successfully, your avt has been set to default";
        } else {
            $_SESSION['error_message'] = "File không tồn tại hoặc đã bị xóa.";
        }
    }

    header("Location:" . $_SESSION['last_link']);
    exit();
}

header("Location: ../Homepage/homepage.php");

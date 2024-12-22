<?php
// require_once "../includes/check.php";
session_start();
include '../includes/DatabaseConnection.php';
include "../includes/Functions.php";

if (isset($_POST['edit_avt'])) {
    $id = $_POST['user_id'];
    $avt_path = CheckUploadImage($_FILES['avt_image'], '../images/avatar/');

    if (empty($avt_path)) {
        $avt_path = "profile.png";
        DeleteAvt($pdo, $id);
        $sql = "UPDATE users
        SET avatar = :avatar
        WHERE user_id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':avatar', $avt_path);
        $statement->bindValue(':id', $id);
        $statement->execute();
        // $_SESSION['error_message'] = "cannot change avt, and your avt is set to default, Please try agian!";
        header("Location:" . $_SESSION['last_link']);
        exit();
    } else {
        DeleteAvt($pdo, $id);
        $sql = "UPDATE users
            SET avatar = :avatar
            WHERE user_id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':avatar', $avt_path);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $_SESSION['success_message'] = "change avatar successfully";
        header("Location:" . $_SESSION['last_link']);
        exit();
    }
}
header("Location: ../Homepage/homepage.php");

<?php
// require_once "../includes/check.php";
session_start();
include '../includes/DatabaseConnection.php';
include "../includes/Functions.php";

if (isset($_POST['delete_avt'])) {
    $user_id = $_POST['user_id'];
    DeleteAvt($pdo, $user_id);
    SetAvtDefault($pdo, $user_id);
    $_SESSION['success_message'] = "delete avt successfully, your avt has been set to default";

    header("Location:" . $_SESSION['last_link']);
    exit();
}

header("Location: ../Homepage/homepage.php");

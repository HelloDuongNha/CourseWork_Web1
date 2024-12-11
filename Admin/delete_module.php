<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Delete Module");

if (isset($_POST['delete_module'])) {
    // 1. Trim and sanitize user input
    $module_id = htmlspecialchars(trim($_POST['module_id']));

    // 2. Check if module_id is empty
    if (empty($module_id)) {
        $_SESSION['error_message'] = 'Module ID is required.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 3. Check if the module exists in the database
    $query = "SELECT * FROM modules WHERE module_id = :module_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_id", $module_id);
    $statement->execute();
    $existing_module = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$existing_module) {
        $_SESSION['error_message'] = 'Module not found.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 4. Delete posts where module_id or repost_module_id matches the given module_id
    $query = "DELETE FROM posts WHERE module_id = :module_id OR repost_module_id = :module_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_id", $module_id);
    $statement->execute();

    // 5. Delete the module from the database
    $query = "DELETE FROM modules WHERE module_id = :module_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_id", $module_id);
    $statement->execute();

    // 6. Set success message and redirect
    $_SESSION['success_message'] = 'Module and related posts deleted successfully';
    header("location:" . $_SESSION['last_link']);
    exit();
}

$output = ob_get_clean();
include '../templates/user_layout.html.php';

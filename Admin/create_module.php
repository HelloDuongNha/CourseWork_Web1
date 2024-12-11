<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Create Module");

if (isset($_POST['create_module'])) {
    // 1. Trim and sanitize user input
    $module_name = htmlspecialchars(trim($_POST['module_name']));

    // 2. Check if the required field is empty
    if (empty($module_name)) {
        $_SESSION['error_message'] = 'Module name is required. Please fill in the field.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 3. Check if the module name already exists in the database
    $query = "SELECT * FROM modules WHERE module_name = :module_name";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_name", $module_name);
    $statement->execute();
    $existing_module = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_module) {
        $_SESSION['error_message'] = 'This module name has already been used, please choose another one!';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 4. Insert new module into the database
    $query = "INSERT INTO modules (module_name) VALUES (:module_name)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_name", $module_name);
    $statement->execute();

    // 5. Set success message and redirect
    $_SESSION['success_message'] = 'Module created successfully';
    header("location:" . $_SESSION['last_link']);
    exit();
}

$output = ob_get_clean();
include '../templates/user_layout.html.php';
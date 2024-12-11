<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Edit Module");

if (isset($_POST['edit_module'])) {
    // 1. Trim and sanitize user inputs
    $module_name = htmlspecialchars(trim($_POST['module_name']));
    $module_id = htmlspecialchars(trim($_POST['module_id']));

    // 2. Check if the required field is empty
    if (empty($module_name)) {
        $_SESSION['error_message'] = 'Module name is required. Please fill in the field.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 3. Check if the module name already exists in the database (excluding the current module)
    $query = "SELECT * FROM modules WHERE module_name = :module_name AND module_id != :module_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_name", $module_name);
    $statement->bindValue(":module_id", $module_id);
    $statement->execute();
    $existing_module = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_module) {
        $_SESSION['error_message'] = 'This module name has already been used, please choose another one!';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 4. Update module name in the database
    $query = "UPDATE modules SET module_name = :module_name WHERE module_id = :module_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":module_name", $module_name);
    $statement->bindValue(":module_id", $module_id);
    $statement->execute();

    // 5. Set success message and redirect
    $_SESSION['success_message'] = 'Module name updated successfully';
    header("location:" . $_SESSION['last_link']);
    exit();
}

$output = ob_get_clean();
include '../templates/user_layout.html.php';

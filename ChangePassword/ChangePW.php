<?php
session_start();
require_once '../includes/DatabaseConnection.php'; // Database connection

if (isset($_POST['change_password'])) {
    // Clean input data
    $user_id = $_POST['user_id'];
    $old_password = trim(strip_tags(htmlspecialchars($_POST['old_password'])));
    $new_password = trim(strip_tags(htmlspecialchars($_POST['new_password'])));
    $confirm_password = trim(strip_tags(htmlspecialchars($_POST['confirm_password'])));

    // Check if fields are not empty
    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error_message'] = 'Please fill in all fields!';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    try {
        // Query
        $query = "SELECT password FROM users WHERE user_id = :user_id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $user = $statement->fetch();

        if (!$user) {
            $_SESSION['error_message'] = 'User not found!';
            header("location:" . $_SESSION['last_link']);
            exit();
        }

        // Check if old password is incorrect
        if (md5($old_password) !== $user['password']) {
            $_SESSION['error_message'] = 'Old password is incorrect!';
            header("location:" . $_SESSION['last_link']);
            exit();
        }

        // Check if new password matches confirm password or not
        if ($new_password !== $confirm_password) {
            $_SESSION['error_message'] = 'New password and confirm password do not match!';
            header("location:" . $_SESSION['last_link']);
            exit();
        }

        // Check if new password is different from the old password
        if (md5($new_password) === $user['password']) {
            $_SESSION['error_message'] = 'New password cannot be the same as the old password. Please choose a different password.';
            header("location:" . $_SESSION['last_link']);
            exit();
        }

        // Update
        $new_password = md5($new_password);
        $query = "UPDATE users SET password = :new_password WHERE user_id = :user_id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':new_password', $new_password);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();

        $_SESSION['success_message'] = 'Password changed successfully!';
        header("location:" . $_SESSION['last_link']);
        exit();

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}

<?php
session_start();
require_once '../includes/DatabaseConnection.php'; // Database connection

if (isset($_POST['login'])) {
    // Clean input data
    $username = trim(strip_tags(htmlspecialchars($_POST['username'])));
    $password = trim(strip_tags(htmlspecialchars($_POST['password'])));

    // Check if the input fields are not empty
    if ($username == "" || $password == "") {
        $_SESSION['error_message'] = 'Please fill in all fields!';
        header("location: login.html.php");
        exit();
    }

    try {
        // Query the database to check user credentials
        $query = "SELECT * FROM users WHERE user_tag = :username OR user_mail = :username";
        $statement = $pdo->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();

        // Check if any user was found
        $user = $statement->fetch();

        if (!$user) {
            // User not found
            $_SESSION['error_message'] = 'Invalid username or password!';
            header("location: login.html.php");
            exit();
        }

        // Check password (compare with hashed password in the database)
        if (md5($password) !== $user['password']) {
            // Incorrect password
            $_SESSION['error_message'] = 'Invalid username or password!';
            header("location: login.html.php");
            exit();
        }

        // Successful login
        $_SESSION['user'] = $user;
        $_SESSION['user_avt'] = $user['avatar'];
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['authorized'] = true;
        $_SESSION['success_message'] = 'Log-in successfully!';

        // Redirect based on user role (user_id = 1 for admin)

        header("location: ../Homepage/homepage.php");

        exit();
    } catch (PDOException $e) {
        // Error during the query
        echo "Database error: " . $e->getMessage();
        exit();
    }
}

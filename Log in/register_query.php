<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (isset($_POST['register_btn'])) {
    // clean input
    $username = trim(strip_tags(htmlspecialchars($_POST['username'])));
    $usertag = trim(strip_tags(htmlspecialchars($_POST['usertag'])));
    $dob = trim(strip_tags(htmlspecialchars($_POST['dob'])));
    $gender = trim(strip_tags(htmlspecialchars($_POST['gender'])));
    $email = trim(strip_tags(htmlspecialchars($_POST['email'])));
    $password = trim(strip_tags(htmlspecialchars($_POST['password'])));
    $confirm_password = trim(strip_tags(htmlspecialchars($_POST['confirm_password'])));
    $created_day = date('Y-m-d');

    // empty check
    if ($username == "" || $usertag == "" || $dob == "" || $gender == "" || $email == "" || $password == "" || $confirm_password == "") {
        $_SESSION['error_message'] = 'Please fill in all fields!';
        header('location: login.html.php');
        exit();
    }

    // Check if the pw is the same with cf pw or note
    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = 'Please check your password or confirm password again!';
        header('location: login.html.php');
        exit();
    }

    // Check if the usertag already exists in the database
    $query = "SELECT * FROM users WHERE user_tag = :usertag";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":usertag", $usertag);
    $statement->execute();
    $existing_user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $_SESSION['error_message'] = 'This user tag already existed, please choose another one!';
        header('location: login.html.php');
        exit();
    }

    // Check if the user mail already exists in the database
    $query = "SELECT * FROM users WHERE user_mail = :mail";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":mail", $email);
    $statement->execute();
    $existing_user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $_SESSION['error_message'] = 'This Mail has already existed, please choose another one!';
        header('location: login.html.php');
        exit();
    }

    // md5
    $password = md5($password);


    try {
        $query = "	INSERT INTO users (user_name, user_tag, user_dob, user_gender, user_mail, account_created_day, password) 
                	VALUES(:name, :tag, :dob, :gender, :mail, :cd, :pw)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(":name", $username);
        $statement->bindValue(":tag", $usertag);
        $statement->bindValue(":dob", $dob);
        $statement->bindValue(":gender", $gender);
        $statement->bindValue(":mail", $email);
        $statement->bindValue(":cd", $created_day);
        $statement->bindValue(":pw", $password);
        
        $statement->execute();
        
        $_SESSION['success_message'] = 'Registration successful! Please log in.';
        header('location: login.html.php');
        exit();
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

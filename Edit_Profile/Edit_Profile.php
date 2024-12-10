<?php
session_start();
include "../includes/Functions.php";
$title = setTitle("Edit Profile");

if (isset($_POST['edit_profile'])) {
    // 1. Trim and sanitize user inputs
    $name = htmlspecialchars(trim($_POST['username']));
    $tag = htmlspecialchars(trim($_POST['usertag']));
    $email = htmlspecialchars(trim($_POST['email']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $dob = htmlspecialchars(trim($_POST['dob']));
    $id = htmlspecialchars(trim($_POST['user_id']));

    // 2. Check if any required field is empty
    if (empty($name) || empty($tag) || empty($email) || empty($gender) || empty($dob)) {
        $_SESSION['error_message'] = 'All fields are required. Please fill in every field.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 3. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 4. Validate gender (in case you only want specific values)
    $allowed_genders = ['Male', 'Female', 'Other'];
    if (!in_array($gender, $allowed_genders)) {
        $_SESSION['error_message'] = 'Invalid gender selected.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 5. Validate date format (Y-m-d)
    $dob_parts = explode('-', $dob);
    if (!checkdate($dob_parts[1], $dob_parts[2], $dob_parts[0])) {
        $_SESSION['error_message'] = 'Invalid date of birth format.';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 6. Check if email already exists in the database (excluding current user)
    $query = "SELECT * FROM users WHERE user_mail = :mail AND user_id != :id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":mail", $email);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $existing_user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $_SESSION['error_message'] = 'This email has already been used, please choose another one!';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 7. Check if usertag already exists in the database (excluding current user)
    $query = "SELECT * FROM users WHERE user_tag = :tag AND user_id != :id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(":tag", $tag);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $existing_user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        $_SESSION['error_message'] = 'This user tag has already been used, please choose another one!';
        header("location:" . $_SESSION['last_link']);
        exit();
    }

    // 8. Update profile in the database
    $last = date('Y-m-d'); // Update last edit date
    updateProfile($pdo, $id, $name, $tag, $email, $gender, $dob, $last);

    // 9. Update the user session data
    $_SESSION['success_message'] = 'Edit Profile Successfully';
    $user = GetAllDataUser($pdo, $id);
    $_SESSION['user'] = $user;

    // 10. Redirect to the profile page
    header("location:" . $_SESSION['last_link']);
    exit();
}

$output = ob_get_clean();
include '../templates/user_layout.html.php';

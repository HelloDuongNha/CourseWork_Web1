<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (isset($_POST['register_btn'])) {
    // Làm sạch dữ liệu đầu vào
    $username = trim(strip_tags(htmlspecialchars($_POST['username'])));
    $usertag = trim(strip_tags(htmlspecialchars($_POST['usertag'])));
    $dob = trim(strip_tags(htmlspecialchars($_POST['dob'])));
    $gender = trim(strip_tags(htmlspecialchars($_POST['gender'])));
    $email = trim(strip_tags(htmlspecialchars($_POST['email'])));
    $password = trim(strip_tags(htmlspecialchars($_POST['password'])));
    $confirm_password = trim(strip_tags(htmlspecialchars($_POST['confirm_password'])));

    // Kiểm tra nếu có trường nào trống
    if ($username == "" || $usertag == "" || $dob == "" || $gender == "" || $email == "" || $password == "" || $confirm_password == "") {
        $_SESSION['error_message'] = 'Please fill in all fields!';
        header('location: login.html.php');
        exit();
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng khớp không
    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = 'Please check your password or confirm password again!';
        header('location: login.html.php');
        exit();
    }

    // Kiểm tra nếu user_tag đã tồn tại trong cơ sở dữ liệu
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

    // Kiểm tra nếu user_mail đã tồn tại trong cơ sở dữ liệu
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

    // Mã hóa mật khẩu
    $password = md5($password);
    $created_day = date('Y-m-d');

    try {
        // Insert query để lưu thông tin người dùng vào database
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
        
        // Sau khi đăng ký thành công, chuyển hướng về trang đăng nhập
        $_SESSION['success_message'] = 'Registration successful! Please log in.';
        header('location: login.html.php');
        exit();
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

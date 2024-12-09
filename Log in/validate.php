<?php
session_start();
require_once '../includes/DatabaseConnection.php'; // Kết nối cơ sở dữ liệu

if (isset($_POST['login'])) {
    // Làm sạch dữ liệu đầu vào
    $username = trim(strip_tags(htmlspecialchars($_POST['username'])));
    $password = trim(strip_tags(htmlspecialchars($_POST['password'])));

    // Kiểm tra nếu các trường nhập không rỗng
    if ($username == "" || $password == "") {
        $_SESSION['error_message'] = 'Please fill in all fields!';
        header("location: login.html.php");
        exit();
    }

    try {
        // Truy vấn cơ sở dữ liệu để kiểm tra thông tin người dùng
        $query = "SELECT * FROM users WHERE user_name = :username OR user_mail = :username";
        $statement = $pdo->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();

        // Kiểm tra nếu có kết quả trả về
        $user = $statement->fetch();

        if (!$user) {
            // Không tìm thấy người dùng
            $_SESSION['error_message'] = 'Invalid username or password!';
            header("location: login.html.php");
            exit();
        }

        // Kiểm tra mật khẩu (so sánh mật khẩu đã mã hóa trong cơ sở dữ liệu)
        if (md5($password) !== $user['password']) {
            // Mật khẩu sai
            $_SESSION['error_message'] = 'Invalid username or password!';
            header("location: login.html.php");
            exit();
        }

        // Đăng nhập thành công
        $_SESSION['user'] = $user;
        $_SESSION['user_avt'] = $user['avatar'];
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['authorized'] = true;
        $_SESSION['success_message'] = 'Log-in successfully!';
        header("location: ../Homepage/homepage.php");
        exit();
        
    } catch (PDOException $e) {
        // Nếu có lỗi trong quá trình truy vấn
        echo "Database error: " . $e->getMessage();
        exit();
    }
}
?>

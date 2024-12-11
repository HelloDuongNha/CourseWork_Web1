<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require '../includes/Functions.php';

$mail = new PHPMailer();
try {
    if (isset($_POST['sending'])) {
        $title = setTitle("Contact Us");
        $name = $_POST['name'];
        $email = htmlspecialchars(trim($_POST['email']));
        $subject = htmlspecialchars(trim($_POST['title']));
        $message = htmlspecialchars(trim($_POST['message']));
        
        //Sender
        sendMailTo($mail, $email, $name, $subject, $message);
        $_SESSION['success_message'] = 'Mail sent successfully!';
        header("Location:" . $_SESSION['last_link']);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['success_message'] = 'Mail sent successfully!' . $mail->ErrorInfo;
}

include '../templates/user_layout.html.php';

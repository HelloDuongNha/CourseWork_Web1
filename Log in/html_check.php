<?php  
if ($_SESSION['authorized'] != true) {
    $_SESSION['error_message'] = "sorry, you can't go to this page";
    header ("location: ../Log in/login.html.php");
} elseif ($_SESSION['user_id'] != 1) {
    $_SESSION['error_message'] = "sorry, you can't go to this page";
    header ("location: ../Homepage/homepage.php");
}
?>
<?php  
if ($_SESSION['authorized'] != true) {
    $_SESSION['error_message'] = "sorry, you can't go to this page";
    header ("location: ../Log in/login.html.php");
} 
?>
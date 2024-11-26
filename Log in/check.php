<?php  
session_start();
if ($_SESSION['authorized'] != true) {
    header ("location: ../Log in/unauthorized.php");
}

?>
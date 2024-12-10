<?php

include_once '../includes/Functions.php';
$title = setTitle("All Public post");
require "../Log in/check.php";


$_SESSION['last_link'] = "../All_users/all_users.php";
$users = GetAllUser($pdo);

include "admin_all_users.html.php";
// $output = setClean();
$output = ob_get_clean();

include '../templates/user_layout.html.php';

?>
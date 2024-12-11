<?php
session_start();
require "../Log in/check.php";
include '../includes/Functions.php';

$_SESSION['last_link'] = "../Homepage/homepage.php";
$title = setTitle("All Public post");
$posts = GetAllPosts($pdo);
$modules = GetAllModule($pdo);
$user = GetAllDataUser($pdo, $_SESSION['user_id']);
$this_user = GetAllDataUser($pdo, $_SESSION['user_id']);
if ($_SESSION['user_id'] == 1) {
    include "../Admin/Admin_homepage.html.php"; // For admin user
} else {
    include "User_homepage.html.php"; // For regular user
}
// $output = setClean();
$output = ob_get_clean();

include '../templates/user_layout.html.php';



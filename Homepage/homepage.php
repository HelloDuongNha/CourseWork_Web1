<?php
// session_start();
require "../Log in/check.php";
include '../includes/Functions.php';

$_SESSION['last_link'] = "../Homepage/homepage.php";
$title = setTitle("All Public post");
$posts = GetAllPosts($pdo);
$modules = GetAllModule($pdo);
include "Admin_homepage.html.php";
// $output = setClean();
$output = ob_get_clean();

include '../templates/user_layout.html.php';



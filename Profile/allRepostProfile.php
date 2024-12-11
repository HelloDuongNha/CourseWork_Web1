<?php
require "../Log in/check.php";
include '../includes/Functions.php';

$_SESSION['last_link'] = "../Profile/allRepostProfile.php";
$title = setTitle("User Post");
$user = GetAllDataUser($pdo, $_SESSION['user_id']);
$this_user = GetAllDataUser($pdo, $_SESSION['user_id']);
$posts = ProfileGetAllRepost($pdo, $_SESSION['user_id']);
$modules = GetAllModule($pdo);
include "../Admin/Admin_homepage.html.php";
$info = ob_get_clean();
include "profile.html.php";
// $output = setClean();
$output = ob_get_clean();
include '../templates/user_layout.html.php';



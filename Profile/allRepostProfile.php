<?php
require "../Log in/check.php";
include '../includes/Functions.php';

$title = setTitle("User Post");
$posts = ProfileGetAllRepost($pdo, $_SESSION['user_id']);
include "../Homepage/homepage.html.php";
$info = ob_get_clean();
include "profile.html.php";
// $output = setClean();
$output = ob_get_clean();
include '../templates/user_layout.html.php';



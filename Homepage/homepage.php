<?php
// session_start();
require "../Log in/check.php";
include '../includes/Functions.php';

// ob_start();
// include '../includes/DatabaseConnection.php';
$title = setTitle("All Public post");
$posts = GetAllPosts($pdo);

include "homepage.html.php";
// $output = setClean();
$output = ob_get_clean();
include '../templates/user_layout.html.php';



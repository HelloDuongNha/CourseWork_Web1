<?php
include_once '../includes/Functions.php';
$title = setTitle("All module");
require "../Log in/check.php";


$_SESSION['last_link'] = "../modules/all_module.php";
$modules = GetAllModule($pdo);
$this_user = GetAllDataUser($pdo, $_SESSION['user_id']);

if ($_SESSION['user_id'] == 1) {
    include "../Admin/Admin_all_module.html.php"; // For admin user
} else {
    include "user_all_module.html.php"; // For regular user
}
// $output = setClean();
$output = ob_get_clean();

include '../templates/user_layout.html.php';

?>
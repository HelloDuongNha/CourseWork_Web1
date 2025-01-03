<?php
// Hiển thị thông báo nếu có lỗi từ session
if (isset($_SESSION['error_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('fail', '" . $_SESSION['error_message'] . "');
            }
        </script>";
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    echo "<script>
            window.onload = function() {
                showCustomAlert('success', '" . $_SESSION['success_message'] . "');
            }
        </script>";
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css?version=7">

    <link rel="stylesheet" href="../css/aside_style.css?version5">
    <link rel="stylesheet" href="../css/create_post_modal_style.css?version=2">
    <link rel="stylesheet" href="../css/create_post_style.css?version=2">
    <link rel="stylesheet" href="../css/custom_alert_style.css?version=1">
    <link rel="stylesheet" href="../css/list_post_style.css?version=3">
    <link rel="stylesheet" href="../css/search_bar_style.css?version=2">
    <link rel="stylesheet" href="../css/profile.css?version=2">

    <title> <?= $title ?> </title>
</head>

<body>
    <!-- alert -->
    <div id="custom-alert">This is alert</div>

    <!-- Modal -->
    <?php 
    include "../Create_Post/create_post_modal.html.php"; 
    include "../Edit_Profile/Edit_Profile.html.php";
    include "../Edit_Post/Edit_Post.html.php";
    include "../Contact_us/contact.html.php";
    include "../ChangePassword/ChangePW.html.php";
    ?>

    <!-- Sidebar left -->
    <?php include "../templates/aside_left.html.php"; ?>

    <!-- Nội dung chính -->
    <div class="container">
        <main class="content">
            <?= $output ?>
        </main>
    </div>

    <!-- Sidebar right -->
    <?php include "../templates/aside_right.html.php"; ?>

    <!-- Footer -->
    <footer style="color: black;">This is footer</footer>

    <!-- javascript functions -->
    <script src="../templates/script.js"></script>
</body>

</html>
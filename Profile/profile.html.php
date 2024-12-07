<?php
// require_once "../includes/check.php";
?>
<div class="profile-display-area">
    <div class="profile-container">
        <div>
            <img style="width: 200px; height: 200px;" class='profile-avatar' src="../avatar/<?= $_SESSION['user_avt'] ?>" />
        </div>
        <div class="profile-header">
            <div class="user-info">
                <span style="font-size: 25px;">
                    <?= $_SESSION['username'] ?>
                </span>

            </div>
        </div>
        <div class="nav-bar">
            <ul class="nav-bar-list">
                <hr>
                <li>
                    <a href="../Profile/ShowUserDetail.php">Edit Profile</a>
                </li>
                <li>
                    <a href="../Profile/allPostProfile.php">All Posts</a>
                </li>
                <li>
                    <a href="../Profile/allRepostProfile.php">All Reposts</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="profile-info-area">
        <?= $info ?>
    </div>


</div>
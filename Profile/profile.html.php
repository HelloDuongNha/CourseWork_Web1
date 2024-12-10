<?php
// require_once "../includes/check.php";
?>
<div class="profile-display-area">
    <div class="profile-container">
        <div >
            <img style="width: 200px; height: 200px; top: -50px; margin-top: 50px;" class='profile-avatar' src="../avatar/<?= $_SESSION['user_avt'] ?>" />

        </div>
        <div class="profile-header">
            <div class="user-info">
                <span style="font-size: 25px;">
                    <?= $user['user_name'] ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ProfileModal" style="text-decoration:none;">
                        <p style="font-size:11px"> <img style="width:20px; height:20px;" src="../icon/edit.png" alt="create"> Edit Profile </p>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ProfileModal" style="text-decoration:none;">
                        <p style="font-size:11px"> <img style="width:20px; height:20px;" src="../icon/edit.png" alt="create"> Edit Profile </p>
                    </a>
                </span>
            </div>
        </div>
        <div class="profile-body" style="padding-top: 0;">
            <div class="profile-column">
                <p><strong>User Tag</strong></p>
                <p>@<?= $user['user_tag'] ?></p>
            </div>
            <div class="profile-column">
                <p><strong>Gender</strong></p>
                <p><?= $user['user_gender'] ?></p>
            </div>
            <div class="profile-column">
                <p><strong>Like</strong></p>
                <p>0</p>
            </div>
            <div class="profile-column">
                <p><strong>Email</strong></p>
                <p><?= $user['user_mail'] ?></p>
            </div>
            <div class="profile-column">
                <p><strong>Day of Birth</strong></p>
                <p><?= $user['user_dob'] ?></p>
            </div>
            <div class="profile-column">
                <p><strong>Comment</strong></p>
                <p>0</p>
            </div>
        </div>
        <div class="nav-bar">
            <ul class="nav-bar-list">
                <hr>
                <li>
                    <a href="../Profile/allPostProfile.php">All Posts</a>
                </li>
                <li>
                    <a href="../Profile/allRepostProfile.php">All Reposts</a>
                </li>
                <li>
                    <a href="../Profile/allRepostProfile.php">Commented</a>
                </li>
                <li>
                    <a href="../Profile/allRepostProfile.php">Liked</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="profile-info-area">
        <?= $info ?>

    </div>


</div>
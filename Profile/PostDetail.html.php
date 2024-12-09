<?php
// require_once "../includes/check.php";
?>
<div class="profile-info-area" style="margin-left:0; margin-right: 0;">
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


    <div class="post-form" style="margin-top: 50px;">
        <div class="post-header">
            <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($user['avatar']) ? $user['avatar'] : 'profile.png' ?>" alt="Avatar">
        </div>

        <div class="post-content">
            <form action="" method="post">
                <h2 style="margin-left: 150px;">User details</h2>
                <br> <br>

                <label for="">Author name</label>
                <input type="text" name="name"
                    value="<?=$_SESSION['user']['user_name']?>" required>
                <label for="">Author email</label>

        </div>
        <hr>
        <div class="post-footer">
            <input type="submit" name="edit" value="Edit">
            </form>
        </div>
    </div>
</div>
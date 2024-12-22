<?php
// require_once "../includes/check.php";
?>
<div class="profile-display-area">
    <div class="profile-container">
        <div>
            <img style="width: 200px; height: 200px; top: -50px; margin-top: 50px;" class='profile-avatar' src="../images/avatar/<?= !empty($this_user['avatar']) ? $this_user['avatar'] : 'profile.png' ?>">
        </div>
        <div style="cursor: pointer;">
            <img class="change-avt-btn" id="check_avt_clicked" src="../images/icon/image-editing.png" alt="Upload Image" width="32" height="32">

            <form action="../Edit_Profile/edit_avatar.php" method="POST" enctype="multipart/form-data" style="display: none;">
                <!-- id -->
                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                <input type="hidden" name="old_avt_path" value="<?=$user['avatar']?>">
                <input type="file" name="avt_image" id="upload-avt" accept="image/*">
                <input type="submit" name="edit_avt" id="upload-avt-form" style="display: none;">
            </form>
        </div>
        <div class="profile-header">
            <div class="user-info">
                <span style="font-size: 25px;">
                    <?= $user['user_name'] ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ProfileModal" style="text-decoration:none;">
                        <div>
                            <p class="icon-button" style="font-size:11px; margin-bottom: 2px;"> <img style="width:20px; height:20px;" src="../images/icon/edit.png" alt="create"> Edit Profile </p>
                        </div>
                    </a>
                    <form action="../Edit_Profile/delete_avatar.php" method="post"
                        onsubmit="return confirm('Are you sure to delete this avatar?');"
                        class="icon-button"
                        style="padding: 0;">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <button type="submit" name="delete_avt" style="background: none; border: none; padding: 0; margin-bottom: 2px;">
                            <p style="font-size:11px; color: #EE243A; margin:0;"><img style="width: 25px; height: 25px;" src="../images/icon/trash_can.png" alt="delete">
                                <strong>remove avatar</strong>
                            </p>
                        </button>
                    </form>
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
        <div class="nav-bar" style="padding: px 5px;">
            <ul class="nav-bar-list">
                <hr style="margin-bottom: 0;">
                <li>
                    <a href="../Profile/allPostProfile.php">All Posts</a>
                </li>
                <li>
                    <a href="../Profile/allRepostProfile.php">All Reposts</a>
                </li>
                <li>
                    <a href="#">Commented</a>
                </li>
                <li>
                    <a href="#">Liked</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="profile-info-area">
        <?= $info ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageButton = document.getElementById('check_avt_clicked');
        const fileInput = document.getElementById('upload-avt');
        const form = document.getElementById('upload-avt-form');

        imageButton.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                form.click();
            }
        });
    });
</script>
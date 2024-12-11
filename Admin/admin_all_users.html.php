<?php
require_once "../Log in/check.php";


foreach ($users as $user) { ?>
    <!-- modal for that post -->
    <?php
    include "../Edit_User/Edit_User.html.php";
    include "../Contact_us/contact_user.html.php";
    ?>
    <div class="profile-display-area" style="margin: 0;">
        <div class="profile-container">
            <div>
                <img style="width: 200px; height: 200px;" class="profile-avatar" src="../images/avatar/<?= !empty($user['avatar']) ? $user['avatar'] : 'profile.png' ?>">
            </div>
            <div class="profile-header">
                <div style="display: flex; justify-content: space-between; margin-top:20px;">
                    <div class="user-info">
                        <span style="font-size: 25px;">
                            <div>
                                <?= $user['user_name'] ?>
                            </div>

                            <button
                                type="button"
                                style="background: none; border: none; padding: 0;"
                                data-bs-toggle="modal"
                                data-bs-target="#UserModal_<?= $user['user_id'] ?>"
                                data-user-id="<?= $user['user_id'] ?>">
                                <p style="font-size: 11px; margin: 0; font-weight: bold; color: #51A8FF; cursor: pointer;">
                                    <img style="width: 20px; height: 20px;" src="../images/icon/edit.png" alt="create"> <strong>Edit Profile</strong>
                                </p>
                            </button>
                            <hr>
                        </span>
                    </div>
                    <div>
                        <!-- Only show the delete button if user_id is not 1 -->
                        <?php if ($user['user_id'] != 1): ?>
                            <!-- delete -->
                            <form action="../Delete_User/delete_user.php" method="post"
                                onsubmit="return confirm(`Are you sure to delete this User, <?= $user['user_name'] ?>?`);"
                                class="icon-button">
                                <input type="hidden" name="delete_user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" style="background: none; border: none; padding: 0;">
                                    <img style="width: 30px; height: 30px;" src="../images/icon/delete.png" alt="delete">
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <div class="profile-body">
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
                    <p> <a class="icon-button" href="#" data-bs-toggle="modal" data-bs-target="#ContactUserModal_<?=$user['user_id']?>">
                            <img style="width: 20px; height: 20px;" src="../images/icon/email.png" alt="contact"><?= $user['user_mail'] ?>
                        </a></p>
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
        </div>
    </div>
<?php }

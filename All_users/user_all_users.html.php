<?php
foreach ($users as $user) { ?>
    <!-- modal for that post -->
    <?php
    include "../Edit_User/Edit_User.html.php";
    include "../Contact_us/contact_user.html.php";
    ?>
    
    <div class="profile-display-area" style="margin: 0;">
        <div class="profile-container">
            <div>
                <img style="width: 200px; height: 200px;" class="profile-avatar" src="../images/avatar/<?= !empty($user['avatar']) ? $user['avatar'] : 'profile.png' ?>" alt="Avatar">
            </div>
            <div class="profile-header">
                <div style="display: flex; justify-content: space-between; margin-top:20px;">
                    <div class="user-info">
                        <span style="font-size: 25px;">
                            <div>
                                <?= $user['user_name'] ?>
                            </div>
                            <hr>
                        </span>
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
                    <?php if ($user['user_id'] == 1): ?>
                        <p>
                            <a class="icon-button" href="#" data-bs-toggle="modal" data-bs-target="#ContactUserModal_<?= $user['user_id'] ?>">
                                <img style="width: 20px; height: 20px;" src="../images/icon/email.png" alt="contact"><?= $user['user_mail'] ?>
                            </a>
                        </p>
                    <?php else: ?>
                        <p>
                            <a href="mailto:<?= $user['user_mail'] ?>"><?= $user['user_mail'] ?></a>
                        </p>
                    <?php endif; ?>
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

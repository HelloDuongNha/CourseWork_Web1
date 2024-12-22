<?php
include "../ChangePassword/ChangePW.html.php";
?>
<aside class="aside-left">
    <div class="logo">
        <a href="">
            <img src="../images/icon/Greenwich.png" alt="Logo">
        </a>
    </div>

    <div class="menu">
        <nav>
            <ul>
                <li class="menu-item">
                    <a class="icon-button" href="../Profile/allPostProfile.php">
                        <img class="post-avatar" src="../images/avatar/<?= !empty($this_user['avatar']) ? $this_user['avatar'] : 'profile.png' ?>">
                        <p>Profile: <?= $this_user['user_name'] ?></p>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="../Homepage/homepage.php">
                        <img src="../images/icon/home.png" alt="Home">Homepage
                    </a>
                </li>
                <li class="menu-item">
                    <?php if ($_SESSION['user_id'] == 1): ?>
                        <a class="icon-button" href="../Admin/Admin_all_users.php">
                            <img src="../images/icon/people.png" alt="contact">All Users
                        </a>
                    <?php else: ?>
                        <a class="icon-button" href="../All_users/User_all_users.php">
                            <img src="../images/icon/people.png" alt="contact">All Users
                        </a>
                    <?php endif; ?>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="#" data-bs-toggle="modal" data-bs-target="#ContactModal">
                        <img src="../images/icon/email.png" alt="contact">Contact us
                    </a>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="../modules/all_module.php">
                        <img src="../images/icon/module.png" alt="contact">All Module
                    </a>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="#" data-bs-toggle="modal" data-bs-target="#ChangePWModal_<?= $this_user['user_id'] ?>">
                        <img src="../images/icon/setting.png" alt="setting">Change Password
                    </a>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="../Log in/logout.php">
                        <img src="../images/icon/logout.png" alt="logout">Logout
                    </a>
                </li>
                <li class="menu-item">
                    <a class="icon-button" href="#" data-bs-toggle="modal" data-bs-target="#CreatePostModal">
                        <img src="../images/icon/edit.png" alt="create"> Create new post
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
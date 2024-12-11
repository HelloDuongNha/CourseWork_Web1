<?php
include "../Create_Post/create_post.html.php";
foreach ($posts as $post):
    if (isset($post['repost_check']) && $post['repost_check'] == 0) { ?>
        <div class="post-form">
            <div class="post-header" style="display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img style="width: 40px; height: 40px;" class="post-avatar" src="../images/avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar">

                    <!-- user info -->
                    <div style="display: flex; flex-direction: column;">
                        <span class="post-username"><?= $post['main_user_name'] ?></span>
                        <span class="post-tag">@<?= $post['main_user_tag'] ?> </span>
                    </div>

                    <!-- post time -->
                    <div style="display: flex; gap: 2px; margin-left: 10px;">
                        <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                        <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>
                    </div>
                    
                    <!-- modal for that post -->
                    <?php
                    include "../Edit_Post/Edit_Post.html.php";
                    include "../Create_Post/create_repost.html.php"
                    ?>
                </div>

            </div>

            <div class="post-content">
                <p><strong>Module: <?= $post['module_name'] ?></strong></p>
                <p><?= $post['post_caption'] ?></p>
                <div class="image-container">
                    <?php
                    if (isset($post['img_path'])) { ?>
                        <img class="back-post-image" src="../images/uploaded_imgs/<?= $post['img_path'] ?>" alt="">
                        <img class="post-image" src="../images/uploaded_imgs/<?= $post['img_path'] ?>" alt="" ?>">
                    <?php } ?>
                </div>
            </div>
            <hr>
            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../images/icon/love.png" alt="love">
                        <span>love</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item" href="">
                        <img src="../images/icon/comment.png" alt="Home">
                        <span>comment</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item" href="#" data-bs-toggle="modal" data-bs-target="#CreateRepostModal_<?= $post['post_id'] ?>" style="text-decoration:none;">
                        <img src="../images/icon/repost.png" alt="Home">
                        <span><?=getRepostCount($pdo, $post['post_id'])?></span>
                    </a>
                </div>
                <div class="bookmark">
                    <a class="menu-item " href="">
                        <img src="../images/icon/book-mark.png" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="repost-form">
            <div class="post-header" style="display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img style="width: 40px; height: 40px;" class="post-avatar" src="../images/avatar/<?= !empty($post['repost_avatar']) ? $post['repost_avatar'] : 'profile.png' ?>">

                    <!-- user info -->
                    <div style="display: flex; flex-direction: column;">
                        <span class="post-username"><?= $post['repost_user_name'] ?></span>
                        <span class="post-tag">@<?= $post['repost_user_tag'] ?> </span>
                    </div>

                    <!-- post time -->
                    <div style="display: flex; gap: 2px; margin-left: 10px;">
                        <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['repost_date'])) ?></span>
                        <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['repost_time'])) ?></span>

                        <!-- need to add repost time -->
                        <!-- <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>  -->
                    </div>
                </div>
            </div>

            <div class="repost-content">
                <p><strong>Module: <?= $post['repost_module_name'] ?></strong></p>
                <p><?= $post['repost_caption'] ?></p>
                <div class="post-inside">
                    <div class="image-container">
                        <?php
                        if (isset($post['img_path']) && $post['img_path'] != "") { ?>
                            <img class="back-post-image" src="../images/uploaded_imgs/<?= $post['img_path'] ?>">
                            <img class="post-image" src="../images/uploaded_imgs/<?= $post['img_path'] ?>" ?>
                        <?php } ?>
                    </div>
                    <div class="repost-header">
                        <img style="width: 40px; height: 40px;" class="post-avatar" src="../images/avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar">
                        <!-- user info -->
                        <div style="display: flex; flex-direction: column;">
                            <span class="post-username"><?= $post['main_user_name'] ?></span>
                            <span class="post-tag">@<?= $post['main_user_tag'] ?> </span>
                        </div>

                        <!-- post time -->
                        <div style="display: flex; gap: 2px; margin: 0 10px;">
                            <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                            <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>
                        </div>

                        <!-- modal for that post -->
                        <?php
                        include "../Edit_Post/Edit_Repost.html.php";
                        include "../Create_Post/create_repost.html.php";
                        ?>
                    </div>
                    <p><strong>Module: <?= $post['module_name'] ?></strong></p>
                    <p><?= $post['post_caption'] ?></p>
                </div>
            </div>
            <hr>
            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../images/icon/love.png" alt="love">
                        <span>love</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item" href="">
                        <img src="../images/icon/comment.png" alt="Home">
                        <span>comment</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item" href="#" data-bs-toggle="modal" data-bs-target="#CreateRepostModal_<?= $post['post_id'] ?>" style="text-decoration:none;">
                        <img src="../images/icon/repost.png" alt="Home">
                        <span><?=getRepostCount($pdo, $post['post_id'])?></span>
                    </a>
                </div>

                <div class="bookmark">
                    <a class="menu-item " href="">
                        <img src="../images/icon/book-mark.png" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>

<?php
    }
endforeach;

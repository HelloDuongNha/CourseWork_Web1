<?php
include "../Create_Post/create_post.html.php";
foreach ($posts as $post):
    if (isset($post['repost_check']) && $post['repost_check'] == 0) { ?>
        <div class="post-form">
            <div class="post-header">
                <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar">
                <div>
                    <span class="post-username"><?= $post['main_user_name'] ?></span>
                    <span class="post-tag">@<?= $post['main_user_tag'] ?> </span>
                </div>
                <div>
                    <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                    <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>
                </div>
            </div>

            <div class="post-content">
                <p><strong>Module: <?= $post['module_name'] ?></strong></p>
                <p><?= $post['post_caption'] ?></p>
                <div class="image-container">
                    <?php
                    if (isset($post['img_path'])) { ?>
                        <img class="back-post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="">
                        <img class="post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="" ?>">
                    <?php } ?>
                </div>
            </div>
            <hr>
            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../icon/love.png" alt="love">
                        <span>love</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item" href="">
                        <img src="../icon/comment.png" alt="Home">
                        <span>comment</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item" href="">
                        <img src="../icon/repost.png" alt="Home">
                        <span>repost</span>
                    </a>
                </div>

                <div class="bookmark">
                    <a class="menu-item " href="">
                        <img src="../icon/book-mark.png" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="repost-form">
            <div class="repost-header">
                <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['repost_avatar']) ? $post['repost_avatar'] : 'profile.png' ?>" alt="Avatar">
                <span class="post-username"><?= $post['repost_user_name'] ?></span> -
                <span class="post-tag">@<?= $post['repost_user_tag'] ?></span> -
                <span class="post-time"><?= date("d/m/Y", strtotime($post['repost_date'])) ?></span>
            </div>

            <div class="repost-content">
                <p><?= $post['repost_caption'] ?></p>
                <div class="post-inside">
                    <div class="image-container">
                        <?php
                        if (isset($post['img_path'])) { ?>
                            <img class="back-post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="">
                            <img class="post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="" ?>
                        <?php } ?>
                    </div>
                    <div class="repost-header">
                        <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar"> <span class="post-username"><?= $post['main_user_name'] ?></span> -
                        <span class="post-tag">@<?= $post['main_user_tag'] ?></span> -
                        <span class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                    </div>
                    <p><?= $post['post_caption'] ?></p>
                </div>
            </div>
            <hr>
            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../icon/love.png" alt="love">
                        <span>love</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item" href="">
                        <img src="../icon/comment.png" alt="Home">
                        <span>comment</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item" href="">
                        <img src="../icon/repost.png" alt="Home">
                        <span>repost</span>
                    </a>
                </div>

                <div class="bookmark">
                    <a class="menu-item " href="">
                        <img src="../icon/book-mark.png" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>

<?php
    }
endforeach;

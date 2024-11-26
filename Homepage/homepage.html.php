<?php
include "../Create_Post/create_post.html.php";
foreach ($posts as $post):
    if (isset($post['repost_check']) && $post['repost_check'] == 0) { ?>
        <div class="post-form">
            <div class="post-header">
                <img class="post-avatar" src="../images/profile.svg" alt="Avatar">
                <span class="post-username"><?= $post['user_name'] ?></span> -
                <span class="post-tag">@<?= $post['user_tag'] ?></span> -
                <span class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
            </div>

            <div class="post-content">
                <p><?= $post['post_caption'] ?></p>
                <img src="<?= $post['img_path'] ?>" alt="">
            </div>

            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../images/love_no_fill.svg" alt="love">
                        <span>love count</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item" href="">
                        <img src="../images/comment.svg" alt="Home">
                        <span>comment count</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item" href="">
                        <img src="../images/share.svg" alt="Home">
                        <span>share count</span>
                    </a>
                </div>
                <div class="bookmark">
                    <a class="menu-item " href="">
                        <img src="../images/bookmark.svg" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="repost-form">
            <div class="repost-header">
                <img class="post-avatar" src="../images/profile.svg" alt="Avatar">
                <span class="post-username"><?= $post['repost_user_name'] ?></span> -
                <span class="post-tag">@<?= $post['repost_user_tag'] ?></span> -
                <span class="post-time"><?= date("d/m/Y", strtotime($post['repost_date'])) ?></span>
            </div>

            <div class="repost-content">
                <p><?= $post['repost_caption'] ?></p>
                <div class="post-inside">
                    <img src="<?= $post['img_path'] ?>" alt="">
                    <div class="repost-header">
                        <img class="post-avatar" src="../images/profile.svg" alt="Avatar">
                        <span class="post-username"><?= $post['user_name'] ?></span> -
                        <span class="post-tag">@<?= $post['user_tag'] ?></span> -
                        <span class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                    </div>
                    <p><?= $post['post_caption'] ?></p>
                </div>
            </div>

            <div class="post-footer">
                <div class="love">
                    <a class="menu-item reaction" href="">
                        <img src="../images/love_no_fill.svg" alt="love">
                        <span class="love">love count</span>
                    </a>
                </div>

                <div class="comment">
                    <a class="menu-item reaction" href="">
                        <img src="../images/comment.svg" alt="Home">
                        <span>comment count</span>
                    </a>
                </div>

                <div class="share">
                    <a class="menu-item reaction" href="">
                        <img src="../images/share.svg" alt="Home">
                        <span>share count</span>
                    </a>
                </div>
                <div class="bookmark">
                    <a class="menu-item reaction" href="">
                        <img src="../images/bookmark.svg" alt="bookmark">
                    </a>
                </div>
            </div>
        </div>

<?php
    }
endforeach;

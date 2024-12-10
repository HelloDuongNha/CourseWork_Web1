<?php
include "../Create_Post/create_post.html.php";
foreach ($posts as $post):
    if (isset($post['repost_check']) && $post['repost_check'] == 0) { ?>
        <div class="post-form">
            <div class="post-header" style="display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar">

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
                </div>

                <!-- tool -->
                <div style="display: flex; flex-direction: row; gap:10px;">
                    <!-- edit -->
                    <div class="icon-button">
                        <button
                            type="button"
                            style="background: none; border: none; padding: 0;"
                            data-bs-toggle="modal"
                            data-bs-target="#EditPostModal_<?= $post['post_id'] ?>"
                            data-post-id="<?= $post['post_id'] ?>">
                            <img style="width: 30px; height: 30px;" src="../icon/edit_post.png" alt="edit">
                        </button>
                    </div>


                    <!-- modal for that post -->
                    <?php
                    include "../Edit_Post/Edit_Post.html.php";
                    ?>

                    <!-- delete -->
                    <form action="../Delete_Post/delete_post.php" method="post"
                        onsubmit="return confirm('Are you sure to delete this Post?');"
                        class="icon-button">
                        <input type="hidden" name="delete_post_id" value="<?= $post['post_id'] ?>">
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <img style="width: 30px; height: 30px;" src="../icon/delete.png" alt="delete">
                        </button>
                    </form>
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
            <div class="post-header" style="display: flex; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['repost_avatar']) ? $post['repost_avatar'] : 'profile.png' ?>">

                    <!-- user info -->
                    <div style="display: flex; flex-direction: column;">
                        <span class="post-username"><?= $post['repost_user_name'] ?></span>
                        <span class="post-tag">@<?= $post['repost_user_tag'] ?> </span>
                    </div>

                    <!-- post time -->
                    <div style="display: flex; gap: 2px; margin-left: 10px;">
                        <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['repost_date'])) ?></span>
                        <!-- need to add repost time -->
                        <!-- <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>  -->
                    </div>
                </div>

                <!-- tool -->
                <div style="display: flex; flex-direction: row; gap:10px;">
                    <!-- edit -->
                    <button
                        type="button"
                        style="background: none; border: none; padding: 0;"
                        data-bs-toggle="modal"
                        data-bs-target="#EditRepostModal_<?= $post['post_id'] ?>"
                        data-post-id="<?= $post['post_id'] ?>">
                        <img style="width: 30px; height: 30px;" src="../icon/edit_post.png" alt="edit">
                    </button>

                    <!-- modal for that post -->
                    <?php
                    include "../Edit_Post/Edit_Repost.html.php";
                    ?>

                    <!-- delete -->
                    <form action="../Delete_Post/delete_post.php" method="post"
                        onsubmit="return confirm('Are you sure to delete this Repost?');"
                        class="icon-button">
                        <input type="hidden" name="delete_repost_id" value="<?= $post['post_id'] ?>">
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <img style="width: 30px; height: 30px;" src="../icon/delete.png" alt="delete">
                        </button>
                    </form>
                </div>
            </div>

            <div class="repost-content">
                <p><strong>Module: <?= $post['repost_module_name'] ?></strong></p>
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
                        <img style="width: 40px; height: 40px;" class="post-avatar" src="../avatar/<?= !empty($post['main_avatar']) ? $post['main_avatar'] : 'profile.png' ?>" alt="Avatar">
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
                    </div>
                    <p><strong>Module: <?= $post['module_name'] ?></strong></p>
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

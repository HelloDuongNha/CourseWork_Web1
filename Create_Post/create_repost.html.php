<div class="modal fade" id="CreateRepostModal_<?= $post['post_id'] ?>" tabindex="-1" aria-labelledby="RepostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?= $user['avatar'] ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $user['user_name'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Create_Post/create_repost.php" method="POST" enctype="multipart/form-data">
                    <!-- get origin post info -->
                    <input type="hidden" name="main_user_tag" value="<?= $post['main_user_tag'] ?>">
                    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                    <input type="hidden" name="post_caption" value="<?= $post['post_caption'] ?>">
                    <input type="hidden" name="post_created_day" value="<?= $post['post_created_day'] ?>">
                    <input type="hidden" name="post_created_time" value="<?= $post['post_created_time'] ?>">
                    <input type="hidden" name="repost_user_id" value="<?= $user['user_id'] ?>">
                    <input type="hidden" name="post_img" value="<?= $post['img_path'] ?>">
                    <input type="hidden" name="post_module_name" value="<?= $post['module_name'] ?>">
                    <!-- Tool chọn Module (cột 2, hàng 1) -->
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Module:</label>
                        <select class="form-select" id="inputGroupSelect01" name="repost_module_id" required>
                            <option value="" disabled="disabled" selected="selected">Select Module</option>
                            <?php
                            foreach ($modules as $module) {
                            ?>
                                <option value="<?= $module['module_id'] ?>">
                                    <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <!-- caption -->
                    <div class="input-group" style="margin-bottom:16px">
                        <span class="input-group-text">Caption</span>
                        <textarea
                            class="form-control create-caption"
                            placeholder="What is your question?"
                            name="repost_caption"
                            style="height: 80px;"
                            required></textarea>
                    </div>
                    <div class="post-inside">
                        <div class="image-container">
                            <?php
                            if (isset($post['img_path']) && $post['img_path'] != "") { ?>
                                <img class="back-post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="">
                                <img class="post-image" src="../uploaded_imgs/<?= $post['img_path'] ?>" alt="" ?>
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
                            <div style="display: flex; gap: 2px; margin-left: 10px;">
                                <span style="margin-left: 10px;" class="post-time"><?= date("d/m/Y", strtotime($post['post_created_day'])) ?></span>
                                <span style="margin-left: 10px;" class="post-time"><?= date("H:i", strtotime($post['post_created_time'])) ?></span>
                            </div>
                        </div>
                        <p style="padding: 0 10px"><strong>Module: <?= $post['module_name'] ?></strong></p>
                        <p style="padding: 0 10px"><?= $post['post_caption'] ?></p>
                    </div>

                    <!-- close and svae button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_post" class="btn btn-primary">Repost</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
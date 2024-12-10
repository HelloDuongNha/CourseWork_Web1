<div class="modal fade" id="EditRepostModal_<?= $post['post_id'] ?>" tabindex="-1" aria-labelledby="RepostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?= $_SESSION['user_avt'] ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $_SESSION['username'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Edit_Post/Edit_Repost.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                    <!-- Tool chọn Module (cột 2, hàng 1) -->
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Module:</label>
                        <select class="form-select" id="inputGroupSelect01" name="module_id">
                            <option value="" disabled="disabled" selected="selected">Select Module</option>
                            <?php
                            foreach ($modules as $module) {
                            ?>
                                <option value="<?= $module['module_id'] ?>"
                                    <?= ($post['repost_module_id'] == $module['module_id']) ? 'selected' : '' ?>>
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
                            placeholder="What are you thinking about?"
                            name="post_caption"
                            style="height: 80px;"
                            required><?= $post['post_caption'] ?></textarea>
                    </div>


                    <!-- close and svae button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_post" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
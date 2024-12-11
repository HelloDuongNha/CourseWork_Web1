<div class="modal fade" id="EditPostModal_<?= $post['post_id'] ?>" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../images/avatar/<?= !empty($this_user['avatar']) ? $this_user['avatar'] : 'profile.png' ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $this_user['user_name'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Edit_Post/Edit_Post.php" method="POST" enctype="multipart/form-data">
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
                                    <?= ($post['module_id'] == $module['module_id']) ? 'selected' : '' ?>>
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

                    <div class="input-group" style="margin-bottom: 16px;">
                        <input type="hidden" id="delete-existing-image-<?= $post['post_id'] ?>" name="delete_existing_image" value="0">
                        <!-- Label: This Post Image -->
                        <label for="old-image-path-<?= $post['post_id'] ?>" class="form-label fw-bold d-block">This Post Image</label>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control old-image-path"
                                value="<?= $post['img_path'] ?>"
                                readonly
                                placeholder="No Image in this post"
                                id="old-image-path-<?= $post['post_id'] ?>">

                            <button
                                type="button"
                                id="delete-old-image-btn-<?= $post['post_id'] ?>"
                                class="btn btn-danger delete-old-image-btn"
                                data-post-id="<?= $post['post_id'] ?>">
                                <img style="width: 30px; height: 30px;" src="../images/icon/delete.png" alt="delete">
                            </button>
                        </div>
                    </div>

                    <div class="input-group" style="margin-bottom: 16px;">
                        <!-- Label: Choose New Image -->
                        <label for="new-image-path-<?= $post['post_id'] ?>" class="form-label fw-bold d-block">Choose New Image</label>
                        <div class="input-group mb-3">
                            <input
                                type="file"
                                class="form-control new-image-path"
                                name="new_post_image"
                                id="new-image-path-<?= $post['post_id'] ?>"
                                accept="image/*">

                            <button
                                type="button"
                                id="delete-new-image-btn-<?= $post['post_id'] ?>"
                                class="btn btn-danger delete-new-image-btn"
                                data-post-id="<?= $post['post_id'] ?>">
                                <img style="width: 30px; height: 30px;" src="../images/icon/delete.png" alt="delete">
                            </button>
                        </div>
                    </div>


                    <script>
                        // Đợi toàn bộ nội dung trang tải
                        window.addEventListener("DOMContentLoaded", function() {
                            // 1. Xóa ảnh cũ
                            document.querySelectorAll('.delete-old-image-btn').forEach(function(button) {
                                button.addEventListener('click', function() {
                                    const postId = this.getAttribute('data-post-id');
                                    const oldImagePathInput = document.getElementById(`old-image-path-${postId}`);
                                    const deleteExistingImageInput = document.getElementById(`delete-existing-image-${postId}`);

                                    // Đặt giá trị của input ẩn thành 1 để cho server biết cần xóa ảnh cũ
                                    deleteExistingImageInput.value = "1";

                                    // Làm trống trường input và cho biết không có ảnh cũ
                                    oldImagePathInput.value = "No image available";
                                    oldImagePathInput.setAttribute("readonly", true);
                                });
                            });

                            // 2. Xóa ảnh mới
                            document.querySelectorAll('.delete-new-image-btn').forEach(function(button) {
                                button.addEventListener('click', function() {
                                    const postId = this.getAttribute('data-post-id');
                                    const newImagePathInput = document.getElementById(`new-image-path-${postId}`);

                                    // Làm trống giá trị của input file
                                    newImagePathInput.value = "";
                                });
                            });
                        });
                    </script>

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
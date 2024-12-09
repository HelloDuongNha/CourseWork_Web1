<div class="post-form" style="margin-top: 10px;">
    <form action="../Create_Post/create_post.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
        <!-- Hàng 1: Avatar, Tool Select Module -->
        <div style="display: flex; gap: 10px;">
            <!-- Avatar (chiếm cả hàng 1 và hàng 2 của cột 1) -->
            <img style="width: 100px; height: 100px; border-radius: 50%; flex-shrink: 0;" src="../avatar/<?= $_SESSION['user_avt'] ?>" alt="Avatar">

            <!-- Cột 2 -->
            <div style="display: flex; flex-direction: column; width: 100%;">
                <!-- Tool chọn Module (cột 2, hàng 1) -->
                <div class="module-selection" style="flex-grow: 1;">
                        <select class="module-option" required="required" name="module_id">
                            <option value="" disabled="disabled" selected="selected">Select Module</option>
                            <?php
                            foreach ($modules as $module) {
                            ?>
                                <option value="<?=$module['module_id']?>">
                                    <?= htmlspecialchars($module['module_name'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                </div>

                <!-- Textarea và Nút Upload Image (cột 2, hàng 2) -->
                <div style="display: flex; align-items: center; gap: 10px;">
                    <textarea class="form-control create-caption" placeholder="What are you thinking about?" name="post_caption" required></textarea>
                    <div class="upload-button" style="cursor: pointer;">
                        <img src="../icon/image-upload.png" alt="Upload Image" width="32" height="32">
                        <input type="file" name="post_image" id="upload-image" accept="image/*" style="display: none;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Hàng 2: Preview ảnh -->
        <div id="image-preview" style="display: none; position: relative; text-align: center;">
            <img id="preview-img" src="#" alt="Image Preview">
            <button class="btn btn-outline-danger" id="remove-image" type="button">&times;</button>
        </div>

        <!-- Hàng 3: Nút Post -->
        <div style="text-align: right;">
            <button class="btn btn-primary" type="submit" name="create_post">Post</button>
        </div>
    </form>
</div>
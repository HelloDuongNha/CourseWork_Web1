<div class="modal fade" id="postModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?= $_SESSION['user_avt'] ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $_SESSION['username'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Create_Post/create_post.php" method="POST" enctype="multipart/form-data">
                    <div class="form-floating">
                        <textarea class="form-control create-caption" placeholder="What are you thinking about?" name="post_caption" style="height: 80px;" required></textarea>
                        <label style="color: #000;" for="floatingPostCaption">What are you thinking about?</label>
                    </div>
                    <!-- Preview ảnh khi đã chọn -->
                    <div id="pop-image-preview" style="display: none; position: relative; text-align: center;">

                        <img id="pop-preview-img" src="#" alt="Image Preview">

                        <button class="btn btn-outline-danger" id="pop-remove-image" type="button">&times;</button>
                    </div>
                    <div class="post-footer">
                        <!-- Nút SVG thay thế cho input file -->
                        <div class="pop-upload-button input-group mb-3" style="display: flex; align-items: left; cursor: pointer;">
                            <img src="../icon/image-upload.png" alt="Upload Image" width="32" height="32" style="cursor: pointer;">
                            <!-- <span style="margin-left: 8px;">Upload Image</span> -->
                            <input type="file" name="post_image" id="pop-upload-image" accept="image/*" style="display: none;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_post" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="post-form">
    <div class="post-header">
        <img class="post-avatar" src="../images/profile.svg" alt="Avatar">
        <span class="post-username"><?= $_SESSION['username'] ?></span>
    </div>

    <div class="create-post-content">
        <form action="../Create_Post/create_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-floating">
                <textarea class="form-control create-caption" placeholder="What are you thinking about?" name="post_caption" style="height: 80px;" required></textarea>
                <label style="color: #000;" for="floatingPostCaption">What are you thinking about?</label>
            </div>
            <!-- Preview ảnh khi đã chọn -->
            <div id="image-preview" style="display: none; position: relative; text-align: center;">
            <div class="image-background">
        <img id="preview-img" src="#" alt="Image Preview">
    </div>
                <button class="btn btn-outline-danger" id="remove-image" type="button" >&times;</button>
            </div>
            <div class="post-footer ">
                <!-- Nút SVG thay thế cho input file -->
                <div class="upload-button" style="display: flex; align-items: left; cursor: pointer;">
                    <img src="../images/add-image.svg" alt="Upload Image" width="32" height="32" style="cursor: pointer;">
                    <span style="margin-left: 8px;">Upload Image</span>
                    <input type="file" name="post_image" id="upload-image" accept="image/*" style="display: none;">
                </div>
            </div>
            <button style="margin-bottom:20px;" class="btn btn-primary" type="create_post" name="create_post">Post</button>
        </form>
    </div>

</div>
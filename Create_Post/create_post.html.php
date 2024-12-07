<div class="post-form">
    <div class="post-header">
        <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?= $_SESSION['user_avt'] ?>">
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
                <img id="preview-img" src="#" alt="Image Preview">
                <button class="btn btn-outline-danger" id="remove-image" type="button">&times;</button>
            </div>
            <div class="create-post-footer" style="margin: 10px 0 20px;">
                <!-- Nút SVG thay thế cho input file -->
                <div class="upload-button">
                    <img src="../icon/image-upload.png" alt="Upload Image" width="32" height="32" style="cursor: pointer;">
                    <!-- <span style="margin-left: 8px;">Upload Image</span> -->
                    <input type="file" name="post_image" id="upload-image" accept="image/*" style="display: none;">
                </div>
            </div>
            <!-- Nút Post căn sang phải -->
            <div style="margin-left:86%;">
                <button style="width:100px;" class="btn btn-primary" type="create_post" name="create_post">Post</button>
            </div>
        </form>
    </div>

</div>
<div class="modal fade" id="ContactModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?=$this_user['avatar']?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $this_user['user_name'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">

                    <label for="basic-url" class="form-label">You are sending to this admin's email</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">admin's email:</span>
                        <input type="text" class="form-control" value="duongnnhgch230313@fpt.edu.vn" disabled readonly id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                    </div>
                </div>
                <br>
                <form action="../Contact_us/contact.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="email" value="duongnnhgch230313@fpt.edu.vn">
                    <input type="hidden" name="name" value="<?= $this_user['user_name'] ?>">
                    <!-- title -->
                    <div class="input-group input-group-lg" style="margin-bottom: 10px;">
                        <span class="input-group-text" id="inputGroup-sizing-lg">Title</span>
                        <input type="text" class="form-control" placeholder="Email's Title" name="title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                    </div>

                    <!-- text -->
                    <div class="form-floating">
                        <textarea class="form-control create-caption" placeholder="What are you thinking about?" name="message" style="height: 80px;" required></textarea>
                        <label style="color: #000;" for="floatingPostCaption">What do you want to send to admin?</label>
                    </div>

                    <div class="post-footer">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="sending" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
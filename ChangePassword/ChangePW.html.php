<div class="modal fade" id="ChangePWModal_<?= $this_user['user_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../images/avatar/<?= !empty($this_user['avatar']) ? $this_user['avatar'] : 'profile.png' ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $this_user['user_name'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="../ChangePassword/ChangePW.php" method="POST" enctype="multipart/form-data">
                    <!-- <input type="hidden" class="form-control" name="email" value="duongnnhgch230313@fpt.edu.vn"> -->
                    <input type="hidden" name="user_id" value="<?= $this_user['user_id'] ?>">

                    <div class="mb-3" style="margin-bottom: 0 !important;">
                        <label for="basic-url" class="form-label">Please Enter Your Old Password</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Old Password:</span>
                            <input type="password" name="old_password" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                    </div>
                    <a id="ForgotPW_Btn" href="#" data-bs-toggle="modal" data-bs-target="#" style="float: right; margin-bottom: 20px;">Forgot Password</a>
                    <br>
                    <label for="basic-url" class="form-label">Enter Your New Password</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">New Password:</span>
                        <input type="password" name="new_password" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                    </div>
                    <br>
                    <label for="basic-url" class="form-label">Confirm Your New Password</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">New Password:</span>
                        <input type="password" name="confirm_password" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                    </div>
                    <div class="post-footer">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="change_password" class="btn btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
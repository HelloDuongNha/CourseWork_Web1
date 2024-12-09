<div class="modal fade" id="ProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width: 50px; height: 50px;" class="post-avatar" src="../avatar/<?= $_SESSION['user_avt'] ?>">
                <h2 class="modal-title fs-5" id="postModalLabel"><?= $_SESSION['username'] ?></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Edit_Profile/Edit_Profile.php" method="POST" enctype="multipart/form-data">
                    <!-- full name -->
                    <div class="input-group" style="margin-bottom:16px">
                        <span class="input-group-text">Full name</span>
                        <input type="text" value="<?= $_SESSION['user']['user_name'] ?>" placeholder="Username" aria-label="First name" name="username" class="form-control" required>
                    </div>
                    <!-- tag -->
                    <div class="input-group flex-nowrap" style="margin-bottom:16px">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                        <input type="text" value="<?= $_SESSION['user']['user_tag'] ?>" class="form-control" placeholder="User Tag"  name="usertag" aria-label="Usertag" aria-describedby="addon-wrapping" required>
                    </div>
                    <!-- email -->
                    <div class="input-group" style="margin-bottom:16px">
                        <span class="input-group-text">Email</span>
                        <input type="text" value="<?= $_SESSION['user']['user_mail'] ?>" aria-label="Email" placeholder="Email"  name="email" class="form-control" required>
                    </div>

                    <!-- gender -->
                    <div class="row mb-3">
                        <legend class="col-sm-2 col-form-label"><strong>Gender</strong></legend>
                        <div class="col-sm-10" style="display: flex; align-items: center;">

                            <!-- male -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="Male"
                                    <?= (isset($_SESSION['user']['user_gender']) && $_SESSION['user']['user_gender'] === 'Male') ? 'checked' : '' ?>
                                    required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>

                            <!-- female -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="Female"
                                    <?= (isset($_SESSION['user']['user_gender']) && $_SESSION['user']['user_gender'] === 'Female') ? 'checked' : '' ?>
                                    required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            <!-- other -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="Other"
                                    <?= (isset($_SESSION['user']['user_gender']) && $_SESSION['user']['user_gender'] === 'Other') ? 'checked' : '' ?>
                                    required>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>
                    <!-- dob -->
                    <div class="row mb-3">
                        <label for="calendar_input" class="col-sm-2 col-form-label" style="white-space: nowrap;">Date of Birth</label>
                        <div class="col-sm-10 right-aligned-input">
                            <input
                                type="date"
                                value="<?= date('Y-m-d', strtotime($_SESSION['user']['user_dob'])) ?>"
                                class="form-control"
                                id="calendar_input"
                                name="dob"
                                required />
                        </div>
                    </div>
                    <!-- <div class="post-footer">
                    </div> -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_profile" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
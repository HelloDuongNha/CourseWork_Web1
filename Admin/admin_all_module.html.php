<button
    type="button"
    style="
        position: fixed; 
        top: 88%;
        left: 70%;
        width: 60px;
        height: 60px;
        background-color: white; 
        border: solid #4EA6FF 2px; 
        border-radius: 50%; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        cursor: pointer;
    "
    data-bs-toggle="modal"
    data-bs-target="#NewModuleModal">
    <img src="../images/icon/edit.png" alt="edit" style="width: 20px; height: 20px;">
</button>

<?php
include "../Admin/create_module.html.php";
foreach ($modules as $module) { ?>
    <!-- modal for that module -->
    <?php
    include "../Admin/edit_module.html.php";
    ?>
    <div class="profile-display-area" style="margin: 0;">
        <div class="profile-container" style="width: 550px;">
            <div class="profile-header" style="margin: 0;">
                <div style="display: flex; justify-content: space-between; margin-top:20px;">
                    <div class="user-info">
                        <span style="font-size: 25px;">
                            <div>
                                <?= $module['module_name'] ?>
                            </div>

                            <button
                                type="button"
                                style="background: none; border: none; padding: 0;"
                                data-bs-toggle="modal"
                                data-bs-target="#ModuleModal_<?= $module['module_id'] ?>">
                                <p style="font-size: 11px; margin: 0; font-weight: bold; color: #51A8FF; cursor: pointer;">
                                    <img style="width: 20px; height: 20px;" src="../images/icon/edit.png" alt="create"> <strong>Edit Module</strong>
                                </p>
                            </button>
                            <hr>
                        </span>
                    </div>
                    <div>
                        <!-- delete -->
                        <form action="../Admin/delete_module.php" method="post"
                            onsubmit="return confirm(`Are you sure to delete this Module, <?= $module['module_name'] ?>?`);"
                            class="icon-button">
                            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                            <button type="submit" name="delete_module" style="background: none; border: none; padding: 0;">
                                <img style="width: 30px; height: 30px;" src="../images/icon/delete.png" alt="delete">
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="profile-body" style="margin: 0;">
                <div class="profile-column">
                    <p><strong>Posted by this module</strong></p>
                    <p><?= CountPostsByModuleId($pdo, $module['module_id']) ?></p>
                </div>
                <div class="profile-column">

                </div>
                <div class="profile-column">

                </div>
                <div class="profile-column">
                    <p><strong>Reposted by this module</strong></p>
                    <p><?= CountPostsByRepostModuleId($pdo, $module['module_id']) ?></p>
                </div>

                <div class="profile-column">

                </div>
                <div class="profile-column">

                </div>
            </div>
        </div>
    </div>
<?php }

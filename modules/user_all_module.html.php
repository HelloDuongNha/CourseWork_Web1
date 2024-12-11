<?php
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
                            <hr>
                        </span>
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

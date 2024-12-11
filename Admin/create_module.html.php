<div class="modal fade" id="NewModuleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Create New Module</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="../Admin/create_module.php" method="POST" enctype="multipart/form-data">
                    <!-- id -->
                    
                    <!-- Module name -->
                    <div class="input-group" style="margin-bottom:16px">
                        <span class="input-group-text">Module Name</span>
                        <input type="text" placeholder="module name" aria-label="First name" name="module_name" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_module" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
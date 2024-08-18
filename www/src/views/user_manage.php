<?php
/**
 * * include layouts
 */
include '../layouts/header.php';
include '../layouts/sidebar.php';

/**
 * * include config
 */
include '../../config/config.php';

/**
 * * include controllers
 */
include '../controllers/user_manage.inc.php';

/**
 * * include models
 */
include '../models/user/user_add_modal.php';
include '../models/user/user_edit_modal.php';
include '../models/user/user_view_modal.php';
include '../models/user/user_delete_modal.php';
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<div class="main-content col-md-10 mt-4 mb-4">
    <div class="tools-container">
        <div class="col mb-2">
            <h5>User Management</h5>
        </div>
        <hr>
        <div class="col mb-3" id="add-new-user-btn">
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                data-bs-target="#add_user_modal" id="add-new-btn">
                <i class="fa-solid fa-user-plus me-2"></i>Add New User</button>
        </div>
        <div class="alert-container col-md-12">
            <?php
            getError();
            getSuccess(); 
            ?>
        </div>
        <div class="row">
            <div class="container">
                <div class="data-container">
                    <table id="nmap_datatables" class="table table-bordered table-striped table-hover table-sm"
                        style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="col-md-2 text-center">Role</th>
                                <th class="col-md-2 text-center">Created Time</th>
                                <th class="col-md-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?=user_datatables($conn)?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
?>
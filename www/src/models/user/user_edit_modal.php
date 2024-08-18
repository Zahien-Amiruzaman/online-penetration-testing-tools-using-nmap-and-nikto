<?php
/**
 * * include config
 */
include '../../config/config.php';

$user_data = get_user_data($conn);
foreach ($user_data as $user) {
?>
<div class="modal fade" id="user_edit_modal<?=$user['user_id']?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-user-pen me-2" id="icon-tools"></i>Edit User Data</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $user_manage_inc_path ?>" method="POST">
                <div class="modal-body">
                    <div class="user-details-container col-md-12">
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">User ID</label>
                                <input type="input" class="form-control form-control-sm" value="<?=$user['user_id']?>"
                                    disabled>
                                <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fullname</label>
                                <input type="input" class="form-control form-control-sm" name="user_fullname"
                                    value="<?=$user['fullname']?>">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control form-control-sm" name="user_email"
                                    value="<?=$user['email']?>">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="input" class="form-control form-control-sm" name="username"
                                    value="<?=$user['username']?>">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">User Type</label>
                                <select class="form-select form-select-sm" name="user_type">
                                    <option selected>Select User Type</option>
                                    <hr>
                                    <option value="Admin">Admin</option>
                                    <option value="Pentester">Pentester</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="edit_user_btn">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}?>
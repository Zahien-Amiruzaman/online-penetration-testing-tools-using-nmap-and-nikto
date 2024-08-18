<?php
/**
 * * include config
 */
include '../../config/config.php';

$user_data = get_user_data($conn);
foreach ($user_data as $user) {
?>
<div class="modal fade" id="user_view_modal<?=$user['user_id']?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-address-book me-2" id="icon-tools"></i>View User Data</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="user-details-container col-md-12">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="input" class="form-control form-control-sm" name="user_fullname"
                                placeholder="<?=$user['fullname']?>" disabled>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control form-control-sm" name="user_email"
                                placeholder="<?=$user['email']?>" disabled>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="input" class="form-control form-control-sm" name="username"
                                placeholder="<?=$user['username']?>" disabled>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User Type</label>
                            <input type="input" class="form-control form-control-sm" name="username"
                                placeholder="<?=$user['user_type']?>" disabled>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Created Time</label>
                            <input type="input" class="form-control form-control-sm" name="username"
                                placeholder="<?=$user['created_time']?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
}?>
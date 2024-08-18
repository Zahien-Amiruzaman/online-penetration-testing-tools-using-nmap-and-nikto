<div class="modal fade" id="add_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-user-plus me-2" id="icon-tools"></i>Add New User</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $user_manage_inc_path ?>" method="POST">
                <div class="modal-body">
                    <div class="user-details-container col-md-12">
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fullname</label>
                                <input type="input" class="form-control form-control-sm" name="user_fullname">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control form-control-sm" name="user_email">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="input" class="form-control form-control-sm" name="username">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control form-control-sm" name="user_password">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-sm"
                                    name="user_password_confirm">
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">User Type</label>
                                <select class="form-select form-select-sm" name="user_type">
                                    <option selected>User Type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Pentester">Pentester</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="add_new_user_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
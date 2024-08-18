<?php
/**
 * * include config
 */
include '../../config/config.php';

$user_data = get_user_data($conn);
foreach ($user_data as $user) {
?>
<div class="modal fade" id="user_delete_modal<?=$user['user_id']?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-user-minus me-2" id="icon-tools"></i>Delete User Data</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $user_manage_inc_path ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                    Are you sure want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger" name="delete_user_btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}?>
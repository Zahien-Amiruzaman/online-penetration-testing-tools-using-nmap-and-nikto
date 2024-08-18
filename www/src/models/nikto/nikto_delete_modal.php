<?php
/**
 * * include config
 */
include '../../config/config.php';

$nikto_scan_data = get_nikto_scan_data($conn);
foreach ($nikto_scan_data as $row) {?>
<div class="modal fade" id="nikto_delete_modal<?=$row['nikto_scan_id']?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-trash me-2" id="icon-tools"></i>Delete Nikto Data</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $nikto_inc_path ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="nikto_scan_id" value="<?=$row['nikto_scan_id']?>">
                    Are you sure want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger" name="delete_nikto_btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>
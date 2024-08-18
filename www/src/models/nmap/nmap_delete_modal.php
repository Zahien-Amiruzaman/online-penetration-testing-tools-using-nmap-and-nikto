<?php
/**
 * * include config
 */
include '../../config/config.php';

$nmap_scan_data = get_nmap_data($conn);
foreach ($nmap_scan_data as $row) {
?>
<div class="modal fade" id="nmap_delete_modal<?=$row['nmap_scan_id']?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa-solid fa-trash me-2" id="icon-tools"></i>Delete Nmap Data</a>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $nmap_inc_path ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="nmap_scan_id" value="<?=$row['nmap_scan_id']?>">
                    Are you sure want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger" name="delete_nmap_btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}?>
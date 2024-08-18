<?php
include '../../config/config.php';

$nikto_scan_data = get_nikto_scan_data($conn);
foreach ($nikto_scan_data as $row) {
    $nikto_scan_id = $row["nikto_scan_id"];
    $nikto_version = $row["nikto_version"];
    $nikto_source_ip = $row["nikto_source_ip"];
    $nikto_target_ip = $row["nikto_target_ip"];
    $target_port = $row["nikto_target_port"];
    $scanned_by = $row["scanned_by"];
    $scan_time = $row["scan_time"];
    ?>
<div class="modal fade" id="nikto_view_modal<?=$nikto_scan_id?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nikto Scan Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="general-details-container">
                    <div class="container col-md-8">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Nikto Verison: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm"
                                    placeholder="<?=$nikto_version?>" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Source IP: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm"
                                    placeholder="<?=$nikto_source_ip?>" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Target IP: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm"
                                    placeholder="<?=$nikto_target_ip?>" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Port: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm"
                                    placeholder="<?=$target_port?>" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Scanned By: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$scanned_by?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Time Scanned: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$scan_time?>"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="details-container">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Description</th>
                                <th class="col-md-2 text-center">URI</th>
                                <th class="text-center">Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($row['details_data'] as $detail_row) {
                                    $details_description = $detail_row['details_description'];
                                    $details_uri = $detail_row['details_uri'];
                                    $details_reference = $detail_row['details_reference'];
                                    ?>
                            <tr>
                                <td class=""><?=$details_description?></td>
                                <td class=""><?=$details_uri?></td>
                                <td class=""><?=$details_reference?></td>
                            </tr>
                            <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }
?>
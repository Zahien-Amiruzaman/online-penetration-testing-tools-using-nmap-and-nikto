<?php
/**
 * * include layouts
 */
include '../layouts/header.php';
include '../layouts/sidebar.php';

/**
 * * include controllers
 */
include '../controllers/nikto.inc.php';

/**
 * * include config
 */
include '../../config/config.php';

/**
 * * include models
 */
include '../models/nikto/nikto_view_modal.php';
include '../models/nikto/nikto_delete_modal.php';
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<div class="main-content col-md-10 mt-4 mb-4">
    <div class="tools-container">
        <h5>Nikto Scan History</h5>
        <hr>
        <div class="alert-container col-md-12">
            <?php
            getError();
            getSuccess();
            ?>
        </div>
        <div class="row">
            <div class="container">
                <div class="data-container">
                    <table id="nikto_datatables" class="table table-bordered table-striped table-hover table-sm" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Source IP</th>
                                <th class="text-center">Target IP</th>
                                <th class="text-center">Port</th>
                                <th class="text-center">Scanned By</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?=nikto_datatables($conn);?>
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
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
include '../controllers/nmap.inc.php';

/**
 * * include models
 */
include '../models/nmap/nmap_view_modal.php';
include '../models/nmap/nmap_delete_modal.php';
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<div class="main-content col-md-10 mt-4 mb-4">
    <div class="tools-container">
        <h5>NMAP Scan History</h5>
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
                    <table id="nmap_datatables" class="table table-bordered table-striped table-hover table-sm"
                        style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th class="col-md-2 text-center">Source IP</th>
                                <th class="col-md-2 text-center">Target IP</th>
                                <th class="col-md-2 text-center">Hostname</th>
                                <th class="col-md-1 text-center">Scan Type</th>
                                <?php
                                if ($_SESSION['user_type'] === 'Admin') {
                                ?>
                                <th class="col-md-2 text-center">Scanned By</th>
                                <?php
                                }
                                ?>
                                <th class="col-md-2 text-center">Time</th>
                                <th class="col-md-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <?=nmap_datatables($conn);?>
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
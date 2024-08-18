<?php
include '../layouts/header.php';
include '../layouts/sidebar.php';
include "../controllers/nikto.inc.php";
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<!-- Tools Container -->
<div class="main-content col-md-10 mt-4 mb-4">
    <div class="tools-container">
        <h5>Nikto Scanning</h5>
        <hr>
        <div class="row">
            <div class="tools-card-container col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Command</h6>
                        <hr>
                        <form action="nikto.php" method="POST">
                            <div class="mb-3 col-md-3">
                                <input type="input" class="form-control" name="inputTarget"
                                    placeholder="Enter Target IP Address">
                            </div>
                            <div class="mb-3 col-md-2">
                                <input type="input" class="form-control" name="inputPortNumber"
                                    placeholder="Port Number">
                            </div>
                            <!-- <div class="col-md-2 mb-3">
                                <select class="form-select form-select-sm" name="scan_type">
                                    <option selected>Scan Type</option>
                                    <hr>
                                    <option value="Normal">Normal</option>
                                    <option value="HTTPS">HTTPS</option>
                                </select>
                            </div> -->
                            <button type="submit" class="btn btn-sm btn-dark me-2" name="nikto_scan" id="btn-tools">Scan
                                Now</button>
                            <button type="button" class="btn btn-sm btn-dark" id="refresh-btn"
                                onclick="window.location.href='<?=$nikto_page?>'">
                                <i class="fa-solid fa-rotate-right me-2"></i>Refresh</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tools-card-container mt-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Result</h6>
                        <hr>
                        <div class="row g-3">
                            <div class="result-container">
                                <div class="alert-container">
                                    <div id="scan-alert" class="alert alert-warning text-center d-none" role="alert">
                                        Scanning in progress
                                    </div>
                                </div>
                                <?php display_nikto_output();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
?>
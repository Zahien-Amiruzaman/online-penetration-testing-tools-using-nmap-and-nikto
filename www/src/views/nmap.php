<?php
/**
 * * include layouts
 */
include '../layouts/header.php';
include '../layouts/sidebar.php';

/**
 * * include controllers
 */
include "../controllers/nmap.inc.php";
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<!-- Tools Container -->
<div class="main-content col-md-10 mt-4 mb-4">
    <div class="tools-container">
        <h5>Nmap Scanning</h5>
        <hr>

        <div class="row">
            <div class="tools-card-container col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Command</h6>
                                <hr>
                                <form action="nmap.php" method="POST" id="nmap-form">
                                    <div class="col-md-3 mb-3">
                                        <input type="input" class="form-control" id="input-ip-add-target"
                                            name="input_target_ip" placeholder="Enter IP Address or URL">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select class="form-select" name="scan_type" id="scan-type">
                                            <option selected>Scan Type</option>
                                            <hr>
                                            <option value="Port">Port Scanning</option>
                                            <option value="Service">Version Scanning</option>
                                            <option value="Hosts">Active Hosts</option>
                                        </select>
                                    </div>
                                    <div id="new-form-container">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-dark me-2" name="nmap_scan"
                                        id="btn-tools">Scan
                                        Now</button>
                                    <button type="button" class="btn btn-sm btn-dark" id="refresh-btn"
                                        onclick="window.location.href='<?=$nmap_page?>'">
                                        <i class="fa-solid fa-rotate-right me-2"></i>Refresh</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tools-card-container mt-3 col-md-12">
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
                                <?=display_nmap_output();?>
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
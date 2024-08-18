<?php
/**
 * * include layouts
 */
include '../layouts/header.php';
include '../layouts/sidebar.php';

/**
 * * include controllers
 */
include '../controllers/dashboard.inc.php';
?>

<style>
body {
    background-color: whitesmoke;
}
</style>

<div class="dashboard-container col-md-10 mt-4 mb-4">
    <div class="row">
        <div class="col mt-1">
            <div class="tools-container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- <p class="card-title mb-3">Target Hostname Scanned</p> -->
                                <p class="card-text text-center">
                                    <strong>
                                        Welcome, <?php echo $username ?>
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-1">
            <div class="tools-container">
                <div class="row justify-content-center">
                    <div class="tools-card-container col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">NMAP Scan</p>
                                <!-- <hr> -->
                                <h3 class="card-text" id="card-count-number">
                                    <strong>
                                        <?php echo get_nmap_row_count($conn, $user_type, $username); ?>
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Nikto Scan</p>
                                <h3 class="card-text" id="card-count-number">
                                    <strong>
                                        <?php echo get_nikto_row_count($conn, $user_type, $username); ?>
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Total Scan</p>
                                <h3 class="card-text" id="card-count-number">
                                    <strong>
                                        <?php echo total_scan($conn, $user_type, $username); ?>
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Total Target</p>
                                <h3 class="card-text" id="card-count-number">
                                    <strong>
                                        <?php echo total_nmap_target($conn, $user_type, $username); ?>
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-1">
            <div class="tools-container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Target Hostname Scanned</p>
                                <hr>
                                <p class="card-text">
                                    <?php get_target_hostname($conn, $user_type, $username);?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">NMAP Scan Type</p>
                                <hr>
                                <p class="card-text">
                                    <?php echo get_nmap_scan_type($conn, $user_type, $username); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-1">
            <div class="tools-container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Target IP Address Scanned</p>
                                <hr>
                                <p class="card-text">
                                    <?php get_target_ip($conn, $user_type, $username);?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-3">Top Pentester</p>
                                <hr>
                                <p class="card-text">
                                    <?php echo fetch_top_pentester($conn); ?>
                                </p>
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
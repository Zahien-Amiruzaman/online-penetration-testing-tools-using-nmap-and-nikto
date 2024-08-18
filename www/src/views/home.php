<?php
include '../src/layouts/header.php';
include '../src/layouts/sidebar.php';
// include "../style.php";
?>

<div class="col-md-10">
    <div class="row">
        <div class="col">
            <div class="tools-container">
                <i class="fa-solid fa-screwdriver-wrench" id="icon-tools"></i>Tools</a>
                <hr>
                <div class="row">
                    <div class="tools-card-container col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">NMAP</h6>
                                <hr>
                                <p class="card-text">Network and Host Discovery</p>
                                <a href="nmap.php" class="btn btn-sm btn-primary col-md-12" id="btn-tools">Open</a>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Nikto</h6>
                                <hr>
                                <p class="card-text">Web Server Vulnerabilities Scanner</p>
                                <a href="nikto.php" class="btn btn-sm btn-primary col-md-12" id="btn-tools">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col mt-4">
            <div class="tools-container">
                <i class="fa-solid fa-table" id="icon-tools"></i>Data Tables</a>
                <hr>
                <div class="row">
                    <div class="tools-card-container col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">NMAP</h6>
                                <hr>
                                <p class="card-text">Network and Host Discovery</p>
                                <a href="#" class="btn btn-sm btn-primary col-md-3" id="btn-tools"
                                    onclick="location.href='nmap.php';">Open</a>
                            </div>
                        </div>
                    </div>
                    <div class="tools-card-container col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Nikto</h6>
                                <hr>
                                <p class="card-text">Web server scanner</p>
                                <a href="nikto.php" class="btn btn-sm btn-primary col-md-3" id="btn-tools">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<?php
include '../src/layouts/footer.php';
?>
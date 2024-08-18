<?php
/**
 * * views path init
 */
$nmap_page = '../views/nmap.php';
$nikto_page = '../views/nikto.php';
$dashboard_page = '../views/dashboard.php';
$nmap_scan_history_page = '../views/nmap_scan_history.php';
$nikto_scan_history_page = '../views/nikto_scan_history.php';
$user_management_page = '../views/user_manage.php';
$login_page = '../../index.php';

/**
 * * controllers path init
 */
$nikto_inc_path = '../controllers/nikto.inc.php';
$nmap_inc_path = '../controllers/nmap.inc.php';
$user_manage_inc_path = '../controllers/user_manage.inc.php';
$logout_inc_path =  '../controllers/logout.inc.php';

/**
 * * session init
 */
$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
?>

<div class="sidebar d-flex flex-column p-3">
    <h5 class="d-flex align-items-center mb-3" id="sidebar-brand">
        <i class="bi bi-layout-sidebar me-2"></i> SentinelScan
    </h5>
    <!-- <hr> -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="../views/dashboard.php" class="nav-link">
                <i class="fa-solid fa-house me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#toolsSubmenu" data-bs-toggle="collapse" class="nav-link">
                <i class="fa-solid fa-screwdriver-wrench me-2"></i>
                <span class="me-auto">Tools</span>
                <i class="fa-solid fa-chevron-down chevron-icon"></i>
            </a>
            <ul class="collapse nav flex-column ms-1 submenu" id="toolsSubmenu">
                <li class="nav-item">
                    <a href="<?= $nmap_page ?>" class="nav-link"> Nmap</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $nikto_page ?>" class="nav-link"> Nikto</a>
                </li>
                <!-- <hr> -->
            </ul>
        </li>
        <li>
            <a href="#dataTablesSubmenu" data-bs-toggle="collapse" class="nav-link">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                <span class="me-auto">Scan History</span>
                <i class="fa-solid fa-chevron-down chevron-icon"></i>
            </a>
            <ul class="collapse nav flex-column ms-1 submenu" id="dataTablesSubmenu">
                <li class="nav-item">
                    <a href="<?= $nmap_scan_history_page ?>" class="nav-link"> Nmap</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $nikto_scan_history_page ?>" class="nav-link"> Nikto</a>
                </li>
                <!-- <hr> -->
            </ul>
        </li>

        <?php
        if ($_SESSION['user_type'] === 'Admin') { ?>
        <li>
            <a href="#managementSubmenu" data-bs-toggle="collapse" class="nav-link">
                <i class="fa-solid fa-gear me-2"></i>
                <span class="me-auto">Management</span>
                <i class="fa-solid fa-chevron-down chevron-icon"></i>
            </a>
            <ul class="collapse nav flex-column ms-1 submenu" id="managementSubmenu">
                <li class="nav-item">
                    <a href="<?= $user_management_page ?>" class="nav-link"> User Management</a>
                </li>
                <!-- <hr> -->
            </ul>
        </li>
        <?php
        }
        ?>
    </ul>

    <ul class="nav nav-pills flex-column mt-auto">
        <li class="nav-item">
            <a href="<?= $logout_inc_path ?>" class="nav-link">
                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out
            </a>
        </li>
    </ul>
</div>
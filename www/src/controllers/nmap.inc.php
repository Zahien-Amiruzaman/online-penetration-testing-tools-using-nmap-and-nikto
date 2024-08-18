<?php
/**
 * * include config
 */
include '../../config/config.php';

/**
 * * include controllers
 */
include '../controllers/alert.inc.php';
include '../controllers/nmap/nmap_delete.inc.php';
include '../controllers/nmap/nmap_display_result.inc.php';
include '../controllers/nmap/nmap_error_handler.inc.php';
include '../controllers/nmap/nmap_get_command.inc.php';
include '../controllers/nmap/nmap_get_results.inc.php';
include '../controllers/nmap/nmap_parse_xml.inc.php';
include '../controllers/nmap/nmap_store_result.inc.php';
include '../controllers/nmap/nmap_table.inc.php';

function display_nmap_output()
{
    $conn = include '../../config/config.php';

    if (!$conn) {
        errorAlertWarning("Database connection failed!");
        return;
    }

    if (isset($_POST['nmap_scan'])) {
        $targetIPUrl = $_POST['input_target_ip'];
        $scanType = $_POST['scan_type'];
        $targetSubnets = '';

        if ($scanType == 'Hosts') {
            $targetSubnets = $_POST['subnet_ip_range'];
        }

        if (!is_valid_target($targetIPUrl)) {
            errorAlertWarning("Invalid target IP address or domain format!");
            return;
        }

        $sourceIP = $_SERVER['REMOTE_ADDR'];
        $scannedBy = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';

        if (!is_valid_scan_type($scanType)) {
            errorAlertWarning("Please choose a scanning type!");
            return;
        }

        if ($scanType == 'Hosts') {
            if (is_valid_subnet_mask($targetSubnets)) {
                errorAlertWarning("Invalid subnet! Please enter an integer between 0 and 32.");
                return;
            }
        }

        $command = get_nmap_command($targetIPUrl, $scanType, $targetSubnets);

        /**
         * start time
         */
        $start_time = microtime(true);

        $output = shell_exec($command);

        /**
         * end time
         */
        $end_time = microtime(true);
        $time_difference = $end_time - $start_time;
        $time_taken = number_format($time_difference, 2);

        if (!$output) {
            errorAlertWarning("No output from Nmap scan!");
            return;
        }

        // $results = null;
        $results = get_nmap_results($output, $scanType, $targetIPUrl);

        if (!$results) {
            return;
        }

        display_scan_results($results, $sourceIP, $scanType, $targetIPUrl, $targetSubnets, $time_taken);
        store_nmap_scan_results($results, $sourceIP, $scanType, $scannedBy, $conn);
    }
}

/**
 * * if the admin click the delete button
 */
if (isset($_POST['delete_nmap_btn'])) {
    $nmap_scan_id = $_POST['nmap_scan_id'];

    delete_nmap_data($conn, $nmap_scan_id);
    header("location: ../views/nmap_scan_history.php?success=delete_success");
}
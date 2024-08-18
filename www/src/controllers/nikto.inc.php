<?php
/**
 * * include config
 */
include '../../config/config.php';

/**
 * * include controllers
 */
include '../controllers/alert.inc.php';
include '../controllers/nikto/nikto_create_temp_file.inc.php';
include '../controllers/nikto/nikto_delete.inc.php';
include '../controllers/nikto/nikto_display_result.inc.php';
include '../controllers/nikto/nikto_error_handler.inc.php';
include '../controllers/nikto/nikto_get_command.inc.php';
include '../controllers/nikto/nikto_get_result.inc.php';
include '../controllers/nikto/nikto_insert_data.inc.php';
include '../controllers/nikto/nikto_parse_xml.inc.php';
include '../controllers/nikto/nikto_table.inc.php';

if (isset($_POST['delete_nikto_btn'])) {
    $nikto_scan_id = $_POST['nikto_scan_id'];

    delete_nikto_data($conn, $nikto_scan_id);
    header("location: ../views/nikto_scan_history.php?success=delete_success");
}

function display_nikto_output()
{
    $conn = include '../../config/config.php';

    if (!$conn) {
        errorAlertWarning("Database connection failed!");
        return;
    }

    if (!isset($_POST['nikto_scan'])) {
        return;
    }

    $targetUrl = $_POST['inputTarget'];
    $inputPort = $_POST['inputPortNumber'];
    $source_ip = $_SERVER['REMOTE_ADDR'];

    if (!is_valid_target($targetUrl) || is_port_empty($inputPort)) {
        errorAlertWarning("Invalid input. Please check target IP, port number!");
        return;
    }

    /**
     * start time
     */
    $start_time = microtime(true);
    $output = create_nikto_temp_file($targetUrl, $inputPort);

    /**
     * end time
     */
    $end_time = microtime(true);
    $time_difference = $end_time - $start_time;
    $time_taken = number_format($time_difference, 2);

    if (!$output) {
        errorAlertWarning("No output from Nikto scan!");
        return;
    }

    $scannedBy = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';

    $results = get_xml_results($output);

    if (!isset($results) || !is_array($results)) {
        errorAlertWarning("No scan results found!");
        return;
    }

    $nikto_version = isset($results['nikto_version']) ? $results['nikto_version'] : 'N/A';
    $target_ip = isset($results['target_ip']) ? $results['target_ip'] : 'N/A';
    $target_port = isset($results['target_port']) ? $results['target_port'] : 'N/A';
    $scan_results = isset($results['scan_results']) ? $results['scan_results'] : [];

    display_nikto_scan($results, $source_ip, $time_taken);

    /**
     * prettier-ignore
     */
    insert_nikto_scan_data($nikto_version, $source_ip, $target_ip, $target_port,
        $scannedBy, $scan_results, $conn);

    mysqli_close($conn);
}

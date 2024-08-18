<?php

/**
 * * get the nmap scan results from the xml output based on the scan type
 */
function get_nmap_results($output, $scanType, $targetIPUrl)
{
    if ($scanType === 'Port') {
        return xml_get_nmap_port($output);
    } else if ($scanType === 'Service') {
        return xml_get_nmap_service($output);
    } else if ($scanType === 'Hosts') {
        return xml_get_nmap_hosts($output, $targetIPUrl);
    }
}

function get_nmap_data($conn)
{
    $nmap_scan_data = [];

    $sql = 'SELECT * FROM nmap_scan ORDER BY scan_time DESC';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nmap_scan_id = $row['nmap_scan_id'];

            $nmap_scan_data[] = [
                'nmap_version' => $row['nmap_version'],
                'nmap_source_ip' => $row['nmap_source_ip'],
                'nmap_target_ip' => $row['nmap_target_ip'],
                'hostname' => $row['nmap_hostname'],
                'nmap_scan_type' => $row['nmap_scan_type'],
                'scanned_by' => $row['scanned_by'],
                'scan_time' => $row['scan_time'],
                'nmap_scan_id' => $nmap_scan_id,
                'port_results' => get_port_results($conn, $nmap_scan_id),
                'host_results' => get_host_results($conn, $nmap_scan_id),
            ];
        }
    }

    $stmt->close();
    return $nmap_scan_data;
}

function get_port_results($conn, $nmap_scan_id)
{
    $port_results = [];

    $sqlPort = "SELECT * FROM nmap_port_scan WHERE nmap_scan_id =?;";
    $stmt = $conn->prepare($sqlPort);
    $stmt->bind_param('i', $nmap_scan_id);
    $stmt->execute();

    $portResults = $stmt->get_result();

    if (mysqli_num_rows($portResults) > 0) {
        while ($portRow = mysqli_fetch_assoc($portResults)) {
            $port_id = $portRow['port_id'];

            $port_results[] = [
                'port_id' => $port_id,
                'port_number' => $portRow['port_number'],
                'protocol' => $portRow['port_protocol'],
                'state' => $portRow['port_state'],
                'service' => $portRow['port_service'],
                'service_results' => get_service_results($conn, $nmap_scan_id, $port_id),
            ];
        }
    }

    return $port_results;
}

function get_service_results($conn, $nmap_scan_id, $port_id)
{
    $service_results = [];

    $sqlService = "SELECT * FROM nmap_service_scan WHERE nmap_scan_id =? AND port_id =?;";
    $stmt = $conn->prepare($sqlService);
    $stmt->bind_param('ii', $nmap_scan_id, $port_id);
    $stmt->execute();
    $serviceResults = $stmt->get_result();

    if (mysqli_num_rows($serviceResults) > 0) {
        while ($serviceRow = mysqli_fetch_assoc($serviceResults)) {
            $service_results[] = [
                'service_id' => $serviceRow['service_id'],
                'service_product' => $serviceRow['service_product'],
                'service_version' => $serviceRow['service_version'],
                'service_cpe' => $serviceRow['service_cpe'],
            ];
        }
    }

    return $service_results;
}

function get_host_results($conn, $nmap_scan_id)
{
    $host_results = [];

    $sql_hosts = "SELECT * FROM nmap_hosts_scan WHERE nmap_scan_id = ?;";
    $stmt = $conn->prepare($sql_hosts);
    $stmt->bind_param('i', $nmap_scan_id);
    $stmt->execute();

    $host_result_query = $stmt->get_result();

    if (mysqli_num_rows($host_result_query) > 0) {
        while ($host_row = mysqli_fetch_assoc($host_result_query)) {
            $host_id = $host_row['host_id'];

            $host_results[] = [
                'host_id' => $host_id,
                'hostname' => $host_row['hostname'],
                'ip_address' => $host_row['ip_address'],
                'state' => $host_row['status'],
            ];
        }
    }

    return $host_results;
}

function get_nmap_row_count($conn)
{
    $sql = "SELECT * FROM nmap_scan";
    $result = $conn->query($sql);

    $row_count = $result->num_rows;

    return $row_count;
}

<?php

/**
 * * store results into database based on scan type
 */
function store_nmap_scan_results($results, $sourceIP, $scanType, $scannedBy, $conn)
{
    if ($scanType === 'Port') {
        store_port_data($results, $sourceIP, $scanType, $scannedBy, $conn);

    } else if ($scanType === 'Service') {
        store_service_data($results, $sourceIP, $scanType, $scannedBy, $conn);

    } else if ($scanType === 'Hosts') {
        store_hosts_data($results, $sourceIP, $scanType, $scannedBy, $conn);
    }
}

function store_scan_data($results, $sourceIp, $scanType, $scannedBy, $conn)
{
    $nmapVersion = $results['general_details']['nmap_version'];
    $targetIp = $results['general_details']['target_ip'];
    $hostname = $results['general_details']['hostname'];

    $sql = "INSERT INTO nmap_scan (nmap_version, nmap_source_ip, nmap_target_ip, nmap_hostname, nmap_scan_type, scanned_by)
            VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $nmapVersion, $sourceIp, $targetIp, $hostname, $scanType, $scannedBy);

    if ($stmt->execute()) {
        $nmapScanId = $stmt->insert_id;
        return $nmapScanId;
    } else {
        throw new Exception('Error inserting scan data: ' . $stmt->error);
    }
}

/**
 * store port scanning type data
 */
function store_port_data($results, $sourceIp, $scanType, $scannedBy, $conn)
{
    $nmapScanId = store_scan_data($results, $sourceIp, $scanType, $scannedBy, $conn);

    $portResults = $results['port_results'];

    $sqlPort = "INSERT INTO nmap_port_scan (port_number, port_protocol, port_state, port_service, nmap_scan_id)
                 VALUES (?,?,?,?,?)";
    $stmtPort = $conn->prepare($sqlPort);

    foreach ($portResults as $portResult) {
        $portNumber = $portResult['port_number'];
        $protocol = $portResult['protocol'];
        $state = $portResult['state'];
        $service = $portResult['service'];

        $stmtPort->bind_param('isssi', $portNumber, $protocol, $state, $service, $nmapScanId);
        $stmtPort->execute();
    }
}

/**
 * store service or version scanning type data
 */
function store_service_data($results, $sourceIp, $scanType, $scannedBy, $conn)
{
    $nmapScanId = store_scan_data($results, $sourceIp, $scanType, $scannedBy, $conn);

    $serviceResults = $results['service_results'];

    $sqlPort = "INSERT INTO nmap_port_scan (port_number, port_protocol, port_state, port_service, nmap_scan_id)
                 VALUES (?,?,?,?,?)";
    $stmtPort = $conn->prepare($sqlPort);

    $sqlService = "INSERT INTO nmap_service_scan (service_product, service_version, service_cpe, nmap_scan_id, port_id)
                    VALUES (?,?,?,?,?)";
    $stmtService = $conn->prepare($sqlService);

    foreach ($serviceResults as $serviceResult) {
        $portNumber = $serviceResult['port_number'];
        $protocol = $serviceResult['protocol'];
        $state = $serviceResult['state'];
        $service = $serviceResult['service'];

        $stmtPort->bind_param('isssi', $portNumber, $protocol, $state, $service, $nmapScanId);

        if ($stmtPort->execute()) {
            $portId = $stmtPort->insert_id;

            $serviceProduct = $serviceResult['product'];
            $serviceVersion = $serviceResult['version'];
            $serviceCpe = $serviceResult['cpe'];

            $stmtService->bind_param('sssii', $serviceProduct, $serviceVersion, $serviceCpe, $nmapScanId, $portId);
            $stmtService->execute();
        }
    }
}

/**
 * store host scanning type data
 */
function store_hosts_data($results, $sourceIP, $scanType, $scannedBy, $conn)
{
    $nmapScanId = store_scan_data($results, $sourceIP, $scanType, $scannedBy, $conn);
    $hostsResults = $results['hosts_results'];

    $sqlHost = "INSERT INTO nmap_hosts_scan (hostname, ip_address, status, nmap_scan_id) VALUES (?,?,?,?)";
    $stmtHost = $conn->prepare($sqlHost);

    foreach ($hostsResults as $hostsResult) {
        $hostname = $hostsResult['hostname'];
        $ip_address = $hostsResult['ip_address'];
        $status = $hostsResult['state'];

        $stmtHost->bind_param('sssi', $hostname, $ip_address, $status, $nmapScanId);
        $stmtHost->execute();
    }
}
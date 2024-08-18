<?php

function xml_get_nmap_port($xml_output)
{
    /**
     * ! uncomment for debugging (display raw XML)
     */
    // echo '<pre>' . htmlspecialchars($xml_output) . '</pre>';

    $xml = simplexml_load_string($xml_output);

    if ($xml === false) {
        $errorMessage = xml_error_string(xml_get_current_parser());
        errorAlertWarning("Error parsing Nmap XML output!");
        return;
    }

    if (!isset($xml->host)) {
        errorAlertWarning("Host is down!");
        return;
    }

    $nmap_version = (string) $xml['version'];
    $target_ip = (string) $xml->host->address['addr'];
    $hostname = isset($xml->host->hostnames->hostname['name']) ? (string) $xml->host->hostnames->hostname['name'] : 'Unknown';

    $port_scan_results = [];

    if (!isset($xml->host->ports) && !isset($xml->host->ports->port)) {
        errorAlertWarning("No port found!");
        return;
    }

    foreach ($xml->host->ports->port as $port) {
        if ($port === null) {
            errorAlertWarning("No port found!");
            return;
        }

        $port_number = (string) $port['portid'];
        $protocol = (string) $port['protocol'];
        $state = (string) $port->state['state'];
        $service = isset($port->service['name']) ? (string) $port->service['name'] : 'Unknown';

        $port_scan_results[] = [
            'port_number' => $port_number,
            'protocol' => $protocol,
            'state' => $state,
            'service' => $service,
        ];
    }

    return [
        'general_details' => [
            'nmap_version' => $nmap_version,
            'target_ip' => $target_ip,
            'hostname' => $hostname,
        ],
        'port_results' => $port_scan_results,
    ];
}

function xml_get_nmap_service($xml_output)
{
    /**
     * ! uncomment for debugging (display raw XML)
     */
    // echo '<pre>' . htmlspecialchars($xml_output) . '</pre>';

    $xml = simplexml_load_string($xml_output);

    if ($xml === false) {
        $errorMessage = xml_error_string(xml_get_current_parser());
        errorAlertWarning("Error parsing Nmap XML output: $errorMessage");
        return;
    }

    if (!isset($xml->host)) {
        errorAlertWarning("Host is down!");
        return;
    }

    $nmap_version = (string) $xml['version'];
    $target_ip = (string) $xml->host->address['addr'];
    $hostname = isset($xml->host->hostnames->hostname['name']) ? (string) $xml->host->hostnames->hostname['name'] : 'Unknown';

    $service_results = [];

    if (!isset($xml->host->ports) && !isset($xml->host->ports->port)) {
        errorAlertWarning("No port found!");
        return;
    }

    foreach ($xml->host->ports->port as $port) {
        if ($port === null) {
            errorAlertWarning("No port found!");
            return;
        }

        $port_number = (string) $port['portid'];
        $protocol = (string) $port['protocol'];
        $state = (string) $port->state['state'];
        $service = isset($port->service['name']) ? (string) $port->service['name'] : 'Unknown';
        $product = isset($port->service['product']) ? (string) $port->service['product'] : 'Unknown';
        $version = isset($port->service['version']) ? (string) $port->service['version'] : 'Unknown';
        $cpe = isset($port->service->cpe) ? (string) $port->service->cpe : 'Unknown';

        $service_results[] = [
            'port_number' => $port_number,
            'protocol' => $protocol,
            'state' => $state,
            'service' => $service,
            'product' => $product,
            'version' => $version,
            'cpe' => $cpe,
        ];
    }

    return [
        'general_details' => [
            'nmap_version' => $nmap_version,
            'target_ip' => $target_ip,
            'hostname' => $hostname,
        ],
        'service_results' => $service_results,
    ];
}

function xml_get_nmap_hosts($xml_output, $targetIPUrl)
{
    // echo '<pre>' . htmlspecialchars($xml_output) . '</pre>';

    $xml = simplexml_load_string($xml_output);

    if ($xml === false) {
        $errorMessage = xml_error_string(xml_get_current_parser());
        errorAlertWarning("Error parsing Nmap XML output: $errorMessage");
        return;
    }

    $nmap_version = (string) $xml['version'];

    foreach ($xml->host as $host) {
        $state = (string) $host->status['state'];
        $ip_address = (string) $host->address['addr'];
        $hostname = (string) $host->hostnames->hostname['name'];

        $hosts_results[] = [
            'state' => $state,
            'ip_address' => $ip_address,
            'hostname' => $hostname,
        ];
    }

    return [
        'general_details' => [
            'nmap_version' => $nmap_version,
            'target_ip' => $targetIPUrl,
            'hostname' => 'N/A',
        ],
        'hosts_results' => $hosts_results,
    ];
}
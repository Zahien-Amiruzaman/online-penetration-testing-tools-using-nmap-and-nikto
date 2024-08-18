<?php

function get_xml_results($xmlOutput)
{
    /**
     * ! uncomment for debugging (display raw XML)
     */
    // echo '<pre>' . htmlspecialchars($xmlOutput) . '</pre>';

    libxml_use_internal_errors(true);
    $errors = libxml_get_errors();
    $xml = simplexml_load_string($xmlOutput);

    if ($errors) {
        // $errorMessage = xml_error_string(xml_get_current_parser());
        errorAlertWarning("Error parsing Nikto XML output!");
        return;
    }

    $parseError = $xml === false;
    $noPluginFound = strpos($xmlOutput, 'No plugins found for any protocol') !== false;

    if ($parseError || $noPluginFound) {
        libxml_clear_errors();
        errorAlertWarning("No web server found in the specified port!");
        return;
    }

    $target_ip = (string) $xml->niktoscan->scandetails['targetip'];
    $target_port = (string) $xml->niktoscan->scandetails['targetport'];
    $nikto_version = (string) $xml->niktoscan['version'];

    $scanResults = [];

    $items = $xml->niktoscan->scandetails->xpath('//item');
    foreach ($items as $item) {
        $description = (string) $item->description;
        $severity = isset($item->severity) ? (string) $item->severity : 'Unknown';
        $uri = isset($item->uri) ? (string) $item->uri : 'N/A';
        $reference = isset($item->references) ? (string) $item->references : 'N/A';

        $scan_results[] = [
            'description' => $description,
            'severity' => $severity,
            'uri' => $uri,
            'reference' => $reference,
        ];
    }

    return [
        'nikto_version' => $nikto_version,
        'target_ip' => $target_ip,
        'target_port' => $target_port,
        'scan_results' => $scan_results,
    ];
}
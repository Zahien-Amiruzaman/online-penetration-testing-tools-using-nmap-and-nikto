<?php

function display_scan_results($results, $sourceIP, $scanType, $targetIPUrl, $targetSubnets, $time_taken)
{
    if ($scanType === 'Port') {
        display_port_scan($results, $sourceIP, $time_taken);
    } else if ($scanType === 'Service') {
        display_service_scan($results, $sourceIP, $time_taken);
    } else if ($scanType === 'Hosts') {
        display_hosts_scan($results, $sourceIP, $targetIPUrl, $targetSubnets, $time_taken);
    }
}

function display_port_scan($results, $sourceIP, $time_taken)
{
    $generalDetails = $results['general_details'];
    $portResults = $results['port_results'];

    successAlert("Scanning Completed!");

    echo <<<HTML
    <div class="general-details-container">
        <div class="container col-md-8">
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">NMAP Version: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[nmap_version]" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Source IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$sourceIP"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Target IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[target_ip]"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Hostname: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[hostname]"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Scan Type: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="Port Scanning"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label class="col-form-label">Time Taken: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$time_taken seconds"
                        disabled>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Port</th>
                    <th class="text-center">Protocol</th>
                    <th class="text-center">State</th>
                    <th class="text-center">Service</th>
                </tr>
            </thead>
            <tbody>
    HTML;

    foreach ($portResults as $result) {
        echo <<<HTML
        <tr>
            <td class='text-center'>{$result['port_number']}</td>
            <td class='text-center'>{$result['protocol']}</td>
            <td class='text-center'>{$result['state']}</td>
            <td class='text-center'>{$result['service']}</td>
        </tr>
        HTML;
    }

    echo <<<HTML
            </tbody>
        </table>
    </div>
    HTML;
}

function display_service_scan($results, $sourceIP, $time_taken)
{
    $generalDetails = $results['general_details'];
    $serviceResults = $results['service_results'];

    successAlert("Scanning Completed!");

    echo <<<HTML
    <div class="general-details-container">
        <div class="container col-md-8">
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">NMAP Version: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[nmap_version]" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Source IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$sourceIP"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Target IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[target_ip]"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Hostname: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[hostname]"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Scan Type: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="Version Scanning"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label class="col-form-label">Time Taken: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$time_taken seconds"
                        disabled>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover table-sm'>
            <thead class='table-dark'>
                <tr>
                    <th class='text-center'>Port</th>
                    <th class='text-center'>Protocol</th>
                    <th class='text-center'>Service</th>
                    <th class='text-center'>Product</th>
                    <th class='text-center'>Version</th>
                    <th class='text-center'>CPE</th>
                </tr>
            </thead>
            <tbody>
    HTML;

    foreach ($serviceResults as $result) {
        echo <<<HTML
        <tr>
            <td class='text-center'>{$result['port_number']}</td>
            <td class='text-center'>{$result['protocol']}</td>
            <td class='text-center'>{$result['service']}</td>
            <td class='text-center'>{$result['product']}</td>
            <td class='text-center'>{$result['version']}</td>
            <td class='text-center'>{$result['cpe']}</td>
        </tr>
        HTML;
    }

    echo <<<HTML
            </tbody>
        </table>
    </div>
    HTML;
}

function display_hosts_scan($results, $sourceIP, $targetIPUrl, $targetSubnets, $time_taken)
{
    $hosts_results = $results['hosts_results'];
    $generalDetails = $results['general_details'];

    successAlert("Scanning Completed!");

    echo <<<HTML
    <div class="general-details-container">
        <div class="container col-md-8">
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">NMAP Version: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$generalDetails[nmap_version]" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Source IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$sourceIP"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Target IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$targetIPUrl"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Subnets: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="/$targetSubnets"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Scan Type: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="Active Hosts"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label class="col-form-label">Time Taken: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$time_taken seconds"
                        disabled>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover table-sm'>
            <thead class='table-dark'>
                <tr>
                    <th class='text-center'>Hostname</th>
                    <th class='text-center'>IP Address</th>
                    <th class='text-center'>Status</th>
                </tr>
            </thead>
            <tbody>
    HTML;

    foreach ($hosts_results as $result) {
        echo <<<HTML
        <tr>
            <td class='text-center'>{$result['hostname']}</td>
            <td class='text-center'>{$result['ip_address']}</td>
            <td class='text-center'>{$result['state']}</td>
        </tr>
        HTML;
    }

    echo <<<HTML
            </tbody>
        </table>
    </div>
    HTML;
}
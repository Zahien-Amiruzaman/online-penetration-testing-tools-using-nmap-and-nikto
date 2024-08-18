<?php

function display_nikto_scan($results, $source_ip, $time_taken)
{
    $nikto_version = isset($results['nikto_version']) ? $results['nikto_version'] : 'N/A';
    $target_ip = isset($results['target_ip']) ? $results['target_ip'] : 'N/A';
    $target_port = isset($results['target_port']) ? $results['target_port'] : 'N/A';
    $scan_results = isset($results['scan_results']) ? $results['scan_results'] : [];

    successAlert("Scanning Completed!");

    echo <<<HTML
    <div class="general-details-container">
        <div class="container col-md-8">
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Nikto Version: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$nikto_version" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Source IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$source_ip"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Target IP: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$target_ip"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Port: </label>
                </div>
                <div class="col-md-6">
                    <input type="input" class="form-control form-control-sm"
                        placeholder="$target_port"
                        disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-md-6" id="text-right">
                    <label for="inputPassword6" class="col-form-label">Time Taken: </label>
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
                <th class='text-center'>Description</th>
                <th class='col-md-1 text-center'>URI</th>
                <th class='text-center'>Reference</th>
            <tbody>
    HTML;

    foreach ($scan_results as $result) {
        echo <<<HTML
        <tr>
            <td>{$result['description']}</td>
            <td>{$result['uri']}</td>
            <td>{$result['reference']}</td>
        </tr>
        HTML;
    }

    echo <<<HTML
            </tbody>
        </table>
    </div>
    HTML;
}
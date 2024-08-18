<?php
include '../../config/config.php';

$nmap_scan_data = get_nmap_data($conn);
foreach ($nmap_scan_data as $row) {
    $nmap_scan_id = $row['nmap_scan_id'];
    $nmap_version = $row['nmap_version'];
    $source_ip = $row['nmap_source_ip'];
    $target_ip = $row['nmap_target_ip'];
    $hostname = $row['hostname'];
    $scan_type = $row["nmap_scan_type"];
    $scanned_by = $row["scanned_by"];
    $scan_time = $row["scan_time"];
    ?>
<div class="modal fade" id="nmap_view_modal<?=$nmap_scan_id?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">NMAP Scan Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="general-details-container">
                    <div class="container col-md-8">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">NMAP Verison: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm"
                                    placeholder="<?=$nmap_version?>" disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Source IP: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$source_ip?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Target IP: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$target_ip?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Hostname: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$hostname?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Scan Type: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$scan_type?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Scanned By: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$scanned_by?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6" id="text-right">
                                <label for="inputPassword6" class="col-form-label">Time Scanned: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="input" class="form-control form-control-sm" placeholder="<?=$scan_time?>"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="details-container">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="table-dark">
                            <tr>
                                <?php if ($scan_type == 'Port') {?>
                                <th class="col-md-1 text-center">Port</th>
                                <th class="text-center">Protocol</th>
                                <th class="text-center">State</th>
                                <th class="text-center">Service</th>
                                <?php } elseif ($scan_type == 'Service') {?>
                                <th class="col-md-1 text-center">Port</th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Version</th>
                                <th class="text-center">CPE</th>
                                <?php } elseif ($scan_type == 'Hosts') {?>
                                <th class="text-center">Hostname</th>
                                <th class="text-center">IP Address</th>
                                <th class="text-center">Status</th>
                                <?php }?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($scan_type == 'Port' || $scan_type == 'Service') {
                                foreach ($row['port_results'] as $port_results) {
                                    $port = $port_results['port_number'];
                                    $protocol = $port_results['protocol'];
                                    $state = $port_results['state'];
                                    $service = $port_results['service'];
                                    ?>
                            <tr>
                                <?php if ($scan_type == 'Port') { ?>
                                <td class="text-center"><?=$port?></td>
                                <td class="text-center"><?=$protocol?></td>
                                <td class="text-center"><?=$state?></td>
                                <td class="text-center"><?=$service?></td>
                                <?php 
                                    } elseif ($scan_type == 'Service') {
                                        foreach ($port_results['service_results'] as $service_result) {
                                            $product = $service_result['service_product'];
                                            $version = $service_result['service_version'];
                                            $cpe = $service_result['service_cpe']; 
                                            ?>
                                <td class="text-center"><?=$port?></td>
                                <td class="text-center"><?=$service?></td>
                                <td class="text-center"><?=$product?></td>
                                <td class="text-center"><?=$version?></td>
                                <td class="text-center"><?=$cpe?></td>
                                <?php 
                                        }
                                    }
                                } ?>
                            </tr>
                            <?php } else if ($scan_type == 'Hosts') {
                                foreach ($row['host_results'] as $host_results) {
                                    $hostname = $host_results['hostname'];
                                    $ip_address = $host_results['ip_address'];
                                    $state = $host_results['state'];
                                    ?>
                            <tr>
                                <td class="text-center"><?=$hostname?></td>
                                <td class="text-center"><?=$ip_address?></td>
                                <td class="text-center"><?=$state?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }
?>
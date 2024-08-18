<?php

function nmap_datatables($conn)
{
    $username = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];

    switch ($user_type) {
        default:
            errorAlertWarning("Unauthorized user type!");
            return;

        case 'Admin':
            $sql = 'SELECT * FROM nmap_scan';
            $stmt = $conn->prepare($sql);
            break;

        case 'Pentester':
            $sql = 'SELECT * FROM nmap_scan WHERE scanned_by = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            break;

    }

    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = [
                'nmap_source_ip' => $row['nmap_source_ip'],
                'nmap_target_ip' => $row['nmap_target_ip'],
                'hostname' => $row['nmap_hostname'],
                'scanType' => $row['nmap_scan_type'],
                'scannedBy' => $row['scanned_by'],
                'scan_time' => $row['scan_time'],
                'nmap_scan_id' => $row['nmap_scan_id'],
            ];

            echo <<<HTML
            <tr>
                <td class="text-center">{$data['nmap_source_ip']}</td>
                <td class="text-center">{$data['nmap_target_ip']}</td>
                <td class="text-center">{$data['hostname']}</td>
                <td class="text-center">{$data['scanType']}</td>
            HTML;

                if ($user_type === 'Admin') {
                    echo <<<HTML
                    <td class="text-center">{$data['scannedBy']}</td>
                    HTML;
                }
            
            echo <<<HTML
                <td class="text-center">{$data['scan_time']}</td>
                <td class="col-md-1 text-center">
                    <!-- view detail button -->
                    <i class="fa-solid fa-eye me-2"
                        style="
                            cursor: pointer;
                            color: grey;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#nmap_view_modal{$data['nmap_scan_id']}">
                    </i>
            HTML;

            if ($user_type === 'Admin') {
                    echo <<<HTML
                    <i class="fa-solid fa-trash-can"
                        style="
                            cursor: pointer;
                            color: red;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#nmap_delete_modal{$data['nmap_scan_id']}">
                    </i>
                    HTML;
                    }

            echo <<<HTML
                </td>
            </tr>
            HTML;
        }
    }
}
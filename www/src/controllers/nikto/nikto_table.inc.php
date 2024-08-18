<?php

function nikto_datatables($conn)
{
    $username = $_SESSION['username'] ?? '';
    $user_type = $_SESSION['user_type'] ?? '';

    $sql = $user_type === 'Admin' ? "SELECT * FROM nikto_scan" : "SELECT * FROM nikto_scan WHERE scanned_by = ?";
    $stmt = $conn->prepare($sql);

    if ($user_type !== 'Admin') {
        $stmt->bind_param("s", $username);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nikto_version = htmlspecialchars($row["nikto_version"]);
            $nikto_source_ip = htmlspecialchars($row["nikto_source_ip"]);
            $nikto_target_ip = htmlspecialchars($row["nikto_target_ip"]);
            $nikto_target_port = htmlspecialchars($row["nikto_target_port"]);
            $scanned_by = htmlspecialchars($row["scanned_by"]);
            $scan_time = htmlspecialchars($row["scan_time"]);
            $nikto_scan_id = htmlspecialchars($row["nikto_scan_id"]);

            echo <<<HTML
            <tr>
                <!-- <td class="col-md-1 text-center">$nikto_version</td> -->
                <td class="text-center">$nikto_source_ip</td>
                <td class="text-center">$nikto_target_ip</td>
                <td class="col-md-1 text-center">$nikto_target_port</td>
                <td class="text-center">$scanned_by</td>
                <td class="text-center">$scan_time</td>
                <td class="col-md-1 text-center">
                    <!-- view detail button -->
                    <i class="fa-solid fa-eye"
                        style="
                            cursor: pointer;
                            color: grey;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#nikto_view_modal$nikto_scan_id">
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
                            data-bs-target="#nikto_delete_modal$nikto_scan_id">
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

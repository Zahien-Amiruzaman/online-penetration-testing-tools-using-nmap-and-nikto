<?php

function get_nikto_scan_data($conn)
{
    $nikto_scan_data = [];

    $sql = "SELECT * FROM nikto_scan ORDER BY scan_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nikto_scan_id = $row["nikto_scan_id"];
            $nikto_version = $row["nikto_version"];
            $nikto_source_ip = $row["nikto_source_ip"];
            $nikto_target_ip = $row["nikto_target_ip"];
            $nikto_target_port = $row["nikto_target_port"];
            $scanned_by = $row["scanned_by"];
            $scan_time = $row["scan_time"];

            $details_sql = "SELECT * FROM nikto_details_scan WHERE nikto_scan_id = ?";
            $details_stmt = $conn->prepare($details_sql);
            $details_stmt->bind_param("i", $nikto_scan_id);
            $details_stmt->execute();
            $details_result = $details_stmt->get_result();

            $details_data = [];

            if ($details_result->num_rows > 0) {
                while ($drow = $details_result->fetch_assoc()) {
                    $details_data[] = [
                        'details_description' => $drow['details_description'],
                        'details_uri' => $drow['details_uri'],
                        'details_reference' => $drow['details_reference'],
                    ];
                }
            }

            $nikto_scan_data[] = [
                'nikto_scan_id' => $nikto_scan_id,
                'nikto_version' => $nikto_version,
                'nikto_source_ip' => $nikto_source_ip,
                'nikto_target_ip' => $nikto_target_ip,
                'nikto_target_port' => $nikto_target_port,
                'scanned_by' => $scanned_by,
                'scan_time' => $scan_time,
                'details_data' => $details_data,
            ];
        }
    }

    return $nikto_scan_data;
}



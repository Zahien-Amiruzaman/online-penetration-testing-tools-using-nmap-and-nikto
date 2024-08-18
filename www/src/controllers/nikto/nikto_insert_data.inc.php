<?php

function insert_nikto_scan_data($nikto_version, $source_ip, $target_ip, $target_port, $scanned_by, $scan_results, $conn)
{
    $sql = "INSERT INTO nikto_scan (nikto_version, nikto_source_ip, nikto_target_ip, nikto_target_port, scanned_by)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nikto_version, $source_ip, $target_ip, $target_port, $scanned_by);

    if ($stmt->execute() !== true) {
        errorAlertWarning("Error inserting data into database!");
        return;
    }

    $nikto_scan_id = $conn->insert_id;

    $sql = "INSERT INTO nikto_details_scan (details_description, details_uri, details_reference, nikto_scan_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $description, $uri, $reference, $nikto_scan_id);

    foreach ($scan_results as $result) {
        $description = $conn->real_escape_string($result['description']);
        $uri = $conn->real_escape_string($result['uri']);
        $reference = $conn->real_escape_string($result['reference']);

        if (!$stmt->execute()) {
            errorAlertWarning("Error inserting data into database!");
            return;
        }
    }
}


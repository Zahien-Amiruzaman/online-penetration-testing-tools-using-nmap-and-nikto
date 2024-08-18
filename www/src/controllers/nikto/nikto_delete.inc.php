<?php

function delete_nikto_data($conn, $nikto_scan_id)
{
    $sql = "DELETE FROM nikto_scan WHERE nikto_scan_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nikto_scan_id);
    $stmt->execute();
}

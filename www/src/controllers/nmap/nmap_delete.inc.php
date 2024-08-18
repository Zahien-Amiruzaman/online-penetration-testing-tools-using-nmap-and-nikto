<?php

function delete_nmap_data($conn, $nmap_scan_id)
{
    $sql = "DELETE FROM nmap_scan WHERE nmap_scan_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nmap_scan_id);
    $stmt->execute();
}
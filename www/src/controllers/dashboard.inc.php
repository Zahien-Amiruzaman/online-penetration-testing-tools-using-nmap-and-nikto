<?php

function get_nikto_row_count($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Pentester') {
        $sql = "SELECT * FROM nikto_scan WHERE scanned_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $scanned_by);
        $stmt->execute();
        $result = $stmt->get_result();
    } else if ($user_type === 'Admin') {
        $sql = "SELECT * FROM nikto_scan";
        $result = $conn->query($sql);
    }

    if ($result) {
        $row_count = $result->num_rows;
    } else {
        $row_count = 0;
    }

    return $row_count;
}

function get_nmap_row_count($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Pentester') {
        $sql = "SELECT * FROM nmap_scan WHERE scanned_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $scanned_by);
        $stmt->execute();
        $result = $stmt->get_result();
    } else if ($user_type === 'Admin') {
        $sql = "SELECT * FROM nmap_scan";
        $result = $conn->query($sql);
    }

    if ($result) {
        $row_count = $result->num_rows;
    } else {
        $row_count = 0;
    }

    return $row_count;
}

function total_scan($conn, $user_type, $scanned_by)
{
    $nikto_count = get_nikto_row_count($conn, $user_type, $scanned_by);
    $nmap_count = get_nmap_row_count($conn, $user_type, $scanned_by);
    return $nikto_count + $nmap_count;
}

// function total_nmap_target($conn, $user_type, $scanned_by)
// {
//     $sql = "SELECT COUNT(DISTINCT nmap_hostname) FROM nmap_scan";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
//     return $row['COUNT(DISTINCT nmap_hostname)'];

//     if ($user_type === 'Admin') {
//         $sql = "SELECT COUNT(DISTINCT nmap_hostname) FROM nmap_scan";
//         $result = mysqli_query($conn, $sql);
//         $row = mysqli_fetch_assoc($result);
//     } else if ($user_type === 'Pentester') {
//         $sql = "SELECT COUNT(DISTINCT nmap_hostname) FROM nmap_scan WHERE scanned_by = ?";
//         $result = mysqli_query($conn, $sql);
//         $stmt->bind_param("s", $scanned_by);
//         $row = mysqli_fetch_assoc($result);
//     }

//     return $row['COUNT(DISTINCT nmap_hostname)'];
// }

function total_nmap_target($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Admin') {
        $sql = "SELECT COUNT(DISTINCT nmap_hostname) AS total_targets FROM nmap_scan";
        $stmt = $conn->prepare($sql);
    } else if ($user_type === 'Pentester') {
        $sql = "SELECT COUNT(DISTINCT nmap_hostname) AS total_targets FROM nmap_scan WHERE scanned_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $scanned_by);
    } else {
        return 0; // Return 0 if the user type is neither Admin nor Pentester
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['total_targets'];
}

function get_target_hostname($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Admin') {
        $sql = "SELECT nmap_hostname, COUNT(*) AS scan_count FROM nmap_scan GROUP BY nmap_hostname
                ORDER BY scan_count DESC LIMIT 3";
        $stmt = $conn->prepare($sql);
    } else if ($user_type === 'Pentester') {
        $sql = "SELECT nmap_hostname, COUNT(*) AS scan_count FROM nmap_scan WHERE scanned_by = ? GROUP BY nmap_hostname
                ORDER BY scan_count DESC LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $scanned_by);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped table-hover table-sm'>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td class='text-center'>" . htmlspecialchars($row["nmap_hostname"]) . "</td><td class='text-center' style='color: #1f5297; width: 50px;'>" . htmlspecialchars($row["scan_count"]) . "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No scans found.";
    }
}

function get_nmap_scan_type($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Admin') {
        $sql = "SELECT nmap_scan_type, COUNT(*) AS scan_type_count FROM nmap_scan GROUP BY nmap_scan_type ORDER BY scan_type_count DESC";
        $stmt = $conn->prepare($sql);
    } else if ($user_type === 'Pentester') {
        $sql = "SELECT nmap_scan_type, COUNT(*) AS scan_type_count FROM nmap_scan WHERE scanned_by = ? GROUP BY nmap_scan_type ORDER BY scan_type_count DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $scanned_by);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped table-hover table-sm'>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td class='text-center'>" . htmlspecialchars($row["nmap_scan_type"]) .
            "</td><td class='text-center' style='color: #1f5297; width: 50px;'>" . htmlspecialchars($row["scan_type_count"]) . "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No scans found.";
    }
}

function get_target_ip($conn, $user_type, $scanned_by)
{
    if ($user_type === 'Admin') {
        $sql = "
            SELECT nmap_target_ip AS target_ip, COUNT(*) AS scan_count
            FROM nmap_scan
            GROUP BY nmap_target_ip
            UNION ALL
            SELECT nikto_target_ip AS target_ip, COUNT(*) AS scan_count
            FROM nikto_scan
            GROUP BY nikto_target_ip
            ORDER BY scan_count DESC
            LIMIT 5
        ";
        $stmt = $conn->prepare($sql);
    } else if ($user_type === 'Pentester') {
        $sql = "
            SELECT nmap_target_ip AS target_ip, COUNT(*) AS scan_count
            FROM nmap_scan
            WHERE scanned_by = ?
            GROUP BY nmap_target_ip
            UNION ALL
            SELECT nikto_target_ip AS target_ip, COUNT(*) AS scan_count
            FROM nikto_scan
            WHERE scanned_by = ?
            GROUP BY nikto_target_ip
            ORDER BY scan_count DESC
            LIMIT 5
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $scanned_by, $scanned_by);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped table-hover table-sm'>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td class='text-center'>" . htmlspecialchars($row["target_ip"]) .
            "</td><td class='text-center' style='color: red; width: 50px;'>" . htmlspecialchars($row["scan_count"]) . "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No scans found.";
    }
}

function fetch_top_pentester($conn)
{
    $sql = "
        SELECT scanned_by, SUM(scan_count) AS total_scans
        FROM (
            SELECT scanned_by, COUNT(*) AS scan_count
            FROM nmap_scan
            GROUP BY scanned_by
            UNION ALL
            SELECT scanned_by, COUNT(*) AS scan_count
            FROM nikto_scan
            GROUP BY scanned_by
        ) AS combined_scans
        GROUP BY scanned_by
        ORDER BY total_scans DESC
        LIMIT 5
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped table-hover table-sm'>";
        // echo "<thead><tr><th class='text-center'>Pentester</th><th class='text-center'>Scan Count</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td class='text-center'>" . htmlspecialchars($row["scanned_by"]) .
            "</td><td class='text-center' style='color: #1f5297; width: 50px;'>" . htmlspecialchars($row["total_scans"]) . "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No scans found.";
    }

    $stmt->close();
}

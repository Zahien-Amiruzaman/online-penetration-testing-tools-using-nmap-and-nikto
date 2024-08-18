<?php

function get_user_data($conn)
{
    $user_data = [];

    $sql = "SELECT * FROM users ORDER BY created_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_data[] = [
                'user_id' => $row['user_id'],
                'fullname' => $row['fullname'],
                'username' => $row['username'],
                'email' => $row['email'],
                'password' => $row['password'],
                'user_type' => $row['user_type'],
                'created_time' => $row['created_time'],
            ];
        }
    }

    return $user_data;
}
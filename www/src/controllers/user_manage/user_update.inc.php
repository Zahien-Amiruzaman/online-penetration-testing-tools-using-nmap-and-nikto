<?php

function update_user($conn, $fullname, $username, $email, $user_type, $user_id)
{
    $sql = "UPDATE users SET fullname = ?, username = ?, email = ?, user_type = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullname, $username, $email, $user_type, $user_id);
    $stmt->execute();
}
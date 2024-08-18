<?php

function delete_user($conn, $user_id)
{
    $sql = "DELETE FROM users WHERE user_id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
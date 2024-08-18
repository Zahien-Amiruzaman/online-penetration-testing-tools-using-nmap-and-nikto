<?php

function add_new_user($conn, $fullname, $username, $email, $password, $user_type)
{
    $sql = "INSERT INTO users (fullname, username, email, password, user_type)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fullname, $username, $email, $password, $user_type);

    if ($stmt->execute()) {
        header("location: ../app/user_management.php?success=true");
    } else {
        errorAlertWarning("Error: " . $stmt->error);
    }
}
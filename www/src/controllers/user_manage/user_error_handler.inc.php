<?php

/**
 * check if the user input is empty
 */
function is_input_empty()
{
    return empty($_POST['user_fullname']) || empty($_POST['user_email']) || empty($_POST['username']) || empty($_POST['user_password']) || empty($_POST['user_password_confirm']);
}

/**
 * check if both password and confirm password are the same
 */
function is_password_match()
{
    return $_POST['user_password'] === $_POST['user_password_confirm'];
}

/**
 * check if the username and email already exists
 */
function user_exists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}
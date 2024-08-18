<?php

session_start();
require_once '../../config/config.php';
include 'alert.inc.php';

if (!isset($_POST['login'])) {
    header("location:../index.php");
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    session_regenerate_id();
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['created_time'] = $row['created_time'];
    session_write_close();

    if ($_SESSION['user_type'] == 'Admin') {
        header("location: ../views/dashboard.php");
    } else {
        header("location: ../views/dashboard.php");
    }

} else {
    header("location: ../../index.php?error=username_password_not_match");
}

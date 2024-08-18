<?php

$host = "mysql-db";
$user = "root";
$password = "password";
$db = "test_database";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
} 

return $conn;
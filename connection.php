<?php
// Connection to db
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "response_report";

try {
    $conn = mysqli_connect($server_name, $username, $password, $database_name);
    if (!$conn) {
        throw new Exception(mysqli_connect_error());
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

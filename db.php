<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "midori";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error", 
        "message" => "Connection failed: " . $conn->connect_error
    ], JSON_UNESCAPED_UNICODE));
}

$conn->set_charset("utf8mb4");
?>
<?php
header("Content-Type: application/json; charset=UTF-8");
require_once 'db.php';

// ดึงประวัติความชื้น 5 รายการล่าสุด
$sensor_query = $conn->query("SELECT * FROM `senser-logs` ORDER BY logsID DESC LIMIT 5");
$sensor_data = $sensor_query->fetch_all(MYSQLI_ASSOC);

// ดึงประวัติการรดน้ำ 5 รายการล่าสุด
$water_query = $conn->query("SELECT * FROM `wetering_history` ORDER BY historyID DESC LIMIT 5");
$water_data = $water_query->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    "status" => "success",
    "sensor_logs" => $sensor_data,
    "watering_history" => $water_data
]);

$conn->close();
?>
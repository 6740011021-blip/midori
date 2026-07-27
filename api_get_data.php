<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

// ดึงประวัติความชื้นล่าสุด 10 รายการ
$sensor_query = "SELECT logsID, moisture, status, created_at FROM `senser-logs` ORDER BY logsID DESC LIMIT 10";
$sensor_result = $conn->query($sensor_query);
$sensor_logs = [];

if ($sensor_result && $sensor_result->num_rows > 0) {
    while ($row = $sensor_result->fetch_assoc()) {
        $sensor_logs[] = $row;
    }
}

// ดึงประวัติการรดน้ำล่าสุด 10 รายการ
$water_query = "SELECT historyID, water_amount_ml, duration_seconds, mode, trigger_source, created_at FROM `wetering_history` ORDER BY historyID DESC LIMIT 10";
$water_result = $conn->query($water_query);
$water_history = [];

if ($water_result && $water_result->num_rows > 0) {
    while ($row = $water_result->fetch_assoc()) {
        $water_history[] = $row;
    }
}

// ส่งข้อมูลกลับเป็น JSON แบบรองรับภาษาไทย
echo json_encode([
    "status" => "success",
    "latest_moisture" => !empty($sensor_logs) ? $sensor_logs[0]['moisture'] : null,
    "sensor_logs" => $sensor_logs,
    "watering_history" => $water_history
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>
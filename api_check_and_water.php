<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

// Mockup Mode: สุ่มค่าความชื้น 20 - 80% (ถ้าไม่ได้ส่งค่ามาทาง POST)
$moisture = isset($_POST['moisture']) ? intval($_POST['moisture']) : rand(20, 80);

// กำหนดข้อความสถานะตามค่าความชื้น
$status = ($moisture < 40) ? "ดินแห้ง (ต้องรดน้ำ)" : "ดินชื้นพอดี (ไม่ต้องรดน้ำ)";

// 1. บันทึกลงตาราง senser-logs (คอลัมน์ moisture)
$stmt1 = $conn->prepare("INSERT INTO `senser-logs` (moisture, status) VALUES (?, ?)");
$stmt1->bind_param("is", $moisture, $status);
$stmt1->execute();
$stmt1->close();

// 2. ถ้าดินแห้ง (< 40%) สั่งรดน้ำและบันทึกลง wetering_history
if ($moisture < 40) {
    $water_amount = 300; // มิลลิลิตร
    $duration = 15;      // วินาที
    $mode = "AUTO";
    $trigger = "Moisture Low (" . $moisture . "%)";

    $stmt2 = $conn->prepare("INSERT INTO `wetering_history` (water_amount_ml, duration_seconds, mode, trigger_source) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("iiss", $water_amount, $duration, $mode, $trigger);
    $stmt2->execute();
    $stmt2->close();

    echo json_encode([
        "status" => "success",
        "action" => "WATERED",
        "moisture" => $moisture,
        "message" => "ดินแห้ง ($moisture%): สั่งเปิดปั๊มน้ำเรียบร้อยแล้ว!"
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "status" => "success",
        "action" => "SKIPPED",
        "moisture" => $moisture,
        "message" => "ดินมีความชื้นพอเหมาะ ($moisture%): ไม่ต้องรดน้ำ"
    ], JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
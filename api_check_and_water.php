<?php
header("Content-Type: application/json; charset=UTF-8");
require_once 'db.php';

// รับค่าความชื้น POST (ถ้าไม่มีส่งมา จะสุ่มค่าจำลอง 20-80%)
$moisture = isset($_POST['moisture']) ? intval($_POST['moisture']) : rand(20, 80);

// 1. เช็กสถานะดิน
$status = ($moisture < 40) ? "ดินแห้ง (ต้องรดน้ำ)" : "ดินชื้นพอดี (ไม่ต้องรดน้ำ)";

// 2. บันทึกลง senser-logs
$stmt1 = $conn->prepare("INSERT INTO `senser-logs` (moisture, status) VALUES (?, ?)");
$stmt1->bind_param("is", $moisture, $status);
$stmt1->execute();
$stmt1->close();

// 3. Logic เงื่อนไข: ถ้าดินแห้ง (< 40%) สั่งรดน้ำและบันทึกลง wetering_history
if ($moisture < 40) {
    $water_amount = 300;
    $duration = 15;
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
        "message" => "ดินแห้ง ($moisture%): ทำการรดน้ำเรียบร้อยแล้ว!"
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "action" => "SKIPPED",
        "moisture" => $moisture,
        "message" => "ดินมีความชื้นพอเหมาะ ($moisture%): ไม่ต้องรดน้ำ"
    ]);
}

$conn->close();
?>
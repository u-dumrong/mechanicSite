<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'คุณไม่ได้ล็อกอิน']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['score'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ไม่มีคะแนนส่งมา']);
    exit();
}

$score = intval($data['score']);
$user_id = $_SESSION['user_id'];

// อัพเดตคะแนนในฐานข้อมูล
require '../dbConfig.php'; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล
$stmt = $conn->prepare("UPDATE students SET score = ? WHERE user_id = ?");
$stmt->bind_param("ii", $score, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => 'คะแนนถูกบันทึกสำเร็จ']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'เกิดข้อผิดพลาดในการบันทึกคะแนน']);
}

$stmt->close();
$conn->close();
?>

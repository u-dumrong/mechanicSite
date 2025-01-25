<?php
$host = 'localhost';
$db = 'exam_system';
$user = 'root';
$pass = ''; // หรือรหัสผ่านที่ใช้งาน

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$startTime = $_POST['start_time'];
$endTime = $_POST['end_time'];

// บันทึกเวลาเริ่มต้นและหมดเวลา
$query = "INSERT INTO exam_time (start_time, end_time) VALUES ('$startTime', '$endTime')";
$conn->query($query);

// ปิดการเชื่อมต่อ
$conn->close();

// ส่งกลับไปยังหน้าเว็บครู
header("Location: teacher_page.php");
exit;
?>

<?php
$servername = "localhost"; // เปลี่ยนตามเซิร์ฟเวอร์ของคุณ
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "test"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าจาก AJAX
$page_name = $_POST['page_name'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

// เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูล
$sql = "UPDATE page_status SET start_time = ?, end_time = ? WHERE page_name = ?";

// ใช้การเตรียมคำสั่ง (prepared statement) เพื่อป้องกัน SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $start_time, $end_time, $page_name);

// ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
if ($stmt->execute()) {
    echo "Page status updated successfully!";
} else {
    echo "Error updating page status: " . $stmt->error;
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>

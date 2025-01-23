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

// รับค่าจากการส่งข้อมูลใน URL
$page_name = $_GET['page_name']; // รับชื่อหน้าจาก URL
$is_visible = $_GET['is_visible'] == 'true' ? 1 : 0; // รับสถานะการแสดงผล

// อัปเดตสถานะในฐานข้อมูล
$sql = "UPDATE page_status SET is_visible = $is_visible WHERE page_name = '$page_name'";

if ($conn->query($sql) === TRUE) {
    echo "Status updated successfully for $page_name";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>

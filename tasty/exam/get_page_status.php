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

// ดึงสถานะการแสดงของหน้าที่ต้องการ
$sql = "SELECT is_visible FROM page_status WHERE page_name = '$page_name'";
$result = $conn->query($sql);

$status = false;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['is_visible'] == 1;
}

$conn->close();

// ส่งกลับเป็น JSON
echo json_encode(["is_visible" => $status]);
?>
<?php
// Get page_name from query parameters
$page_name = $_GET['page_name'];

$servername = "localhost"; // เปลี่ยนตามเซิร์ฟเวอร์ของคุณ
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "test"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get start_time and end_time
$sql = "SELECT start_time, end_time FROM page_status WHERE page_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $page_name);
$stmt->execute();
$stmt->bind_result($start_time, $end_time);

// Fetch the results
if ($stmt->fetch()) {
    echo json_encode([
        'start_time' => $start_time,
        'end_time' => $end_time
    ]);
} else {
    echo json_encode([
        'error' => 'No data found for this page'
    ]);
}

// Close the connection
$stmt->close();
$conn->close();
?>

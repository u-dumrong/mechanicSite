<?php
$host = 'localhost';
$db = 'exam_system';
$user = 'root';
$pass = ''; // หรือรหัสผ่านที่ใช้งาน

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM exam_time ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time']
    ]);
} else {
    echo json_encode([
        'start_time' => null,
        'end_time' => null
    ]);
}

$conn->close();
?>

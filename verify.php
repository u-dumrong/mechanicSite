<?php
/*
include 'dbConfig.php';

if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);

    // ตรวจสอบโทเค็น
    $sql = "SELECT * FROM signup WHERE token='$token' AND is_verified=0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // อัปเดตสถานะการยืนยัน
        $updateSql = "UPDATE signup SET is_verified=1, token=NULL WHERE token='$token'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Email verified successfully! You can now log in.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid or expired token!";
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
*/
?>

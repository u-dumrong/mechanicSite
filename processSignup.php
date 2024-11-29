<?php
// เรียก config.php
include 'dbConfig.php';

// รับค่าจาก JavaScript
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน

    // สร้างคำสั่ง SQL
    $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>

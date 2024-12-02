<?php
// เรียก config.php
include 'dbConfig.php';

/*
    - รับค่าจาก JavaScript
    - ตรวจสอบว่าคำขอที่เข้ามาเป็นแบบ POST
    - รับข้อมูล username, email, และ password จากฟอร์ม
    - กำหนดมาตรการความปลอดภัย:
        1. ป้องกัน SQL Injection ด้วย real_escape_string
        2. เข้ารหัสรหัสผ่าน ด้วย password_hash
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน

    // ตรวจสอบรูปแบบอีเมล (วิธีที่ 1)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "รูปแบบอีเมลไม่ถูกต้อง!";
        exit; // หยุดกระบวนการถ้าอีเมลไม่ถูกต้อง
    }

    // ตรวจสอบว่ามี username หรือ email ซ้ำหรือไม่
    $checkSql = "SELECT * FROM signup WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // ถ้ามีข้อมูลซ้ำ
        echo "เกิดข้อผิดพลาด: ชื่อหรืออีเมลนี้ถูกใช้แล้ว!";
    } else {
        // ถ้าไม่มีข้อมูลซ้ำ ให้เพิ่มข้อมูลใหม่
        $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";

        // ถ้าลงชื่อเข้าใช้ไม่สำเร็จจะแจ้งข้อผิดพลาด
        if ($conn->query($sql) === TRUE) {
            echo "ลงชื่อเข้าใช้สำเร็จ!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// ปิดการเชื่อมต่อ
$conn->close();

/*
<?php
// เรียก config.php
include 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // ตรวจสอบรูปแบบอีเมล (วิธีที่ 1)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit; // หยุดกระบวนการถ้าอีเมลไม่ถูกต้อง
    }

    // ตรวจสอบว่ามี username หรือ email ซ้ำหรือไม่
    $checkSql = "SELECT * FROM signup WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // ถ้ามีข้อมูลซ้ำ
        echo "Error: Username or Email already exists!";
    } else {
        // สร้างโทเค็นสำหรับยืนยันอีเมล
        $token = bin2hex(random_bytes(32));

        // เพิ่มข้อมูลผู้ใช้ลงในฐานข้อมูล พร้อมสถานะยังไม่ยืนยัน
        $sql = "INSERT INTO signup (username, email, password, token, is_verified) VALUES ('$username', '$email', '$password', '$token', 0)";
        
        if ($conn->query($sql) === TRUE) {
            // ส่งอีเมลยืนยัน (วิธีที่ 4)
            $verificationLink = "https://yourdomain.com/verify.php?token=$token";
            $subject = "Verify Your Email";
            $message = "Hi $username,\n\nPlease click the link below to verify your email:\n$verificationLink\n\nThank you!";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "Signup successful! Please check your email to verify your account.";
            } else {
                echo "Error sending verification email!";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
*/
?>

<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // ถ้ายังไม่ได้ล็อกอิน ส่งไปหน้า login
    exit();
}

// ดึงข้อมูลผู้ใช้จาก session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
    <link rel="stylesheet" href="styles.css">
    <style>/*
        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .profile-info {
            margin: 20px 0;
        }
        .profile-info p {
            font-size: 16px;
            margin: 10px 0;
        }
        .button-container {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }*/
    </style>
    <style>
        .button-container {
            display: flex;
            flex-direction: column; /* แนวตั้ง */
            align-items: center;      /* กลาง แนวนอน */          /* ลบ margin ของ body */
        }
        button {
            margin: 10px auto;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>โปรไฟล์ของคุณ</h2>
        <!-- <div class="profile-info"> -->
            <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>อีเมล:</strong> <?php echo htmlspecialchars($email); ?></p>
        <!-- </div> -->
        <div class="button-container">
        <button onclick="window.location.href='main.html'">กลับไปหน้าหลัก</button>
        <button onclick="window.location.href='logout.php'">ลงชื่อออก</button>
        </div>
    </div>
</body>
</html>

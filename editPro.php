<?php
session_start();
require 'dbConfig.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // ถ้ายังไม่ได้ล็อกอิน ส่งไปหน้า login
    exit();
}

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลพื้นฐานจากตาราง users
$stmt = $conn->prepare("SELECT username, email, role, profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $role, $profile_picture);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
</head>
<body>
    <h1>โปรไฟล์ของคุณ</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="profile_picture">เลือกรูปภาพ:</label>
        <input type="file" name="profile_picture" accept="image/*" required>
        <button type="submit">อัปโหลด</button>
    </form>
    <br>
    <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($username); ?></p>
    <p><strong>อีเมล:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>สถานะ:</strong> <?php echo htmlspecialchars($role === 'student' ? 'นักศึกษา' : 'ครู'); ?></p>
    <p><strong>รูปโปรไฟล์:</strong> 
    <?php
session_start();
// เชื่อมต่อฐานข้อมูล
require 'dbConfig.php'; 

// ตรวจสอบว่า user_id มีอยู่ใน session หรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่มี user_id แสดงว่าไม่สามารถเข้าถึงหน้านี้ได้
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลชื่อไฟล์รูปโปรไฟล์จากฐานข้อมูล
$stmt = $conn->prepare("SELECT profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profile_picture);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

    <?php require 'profile_picture.php'; ?>

        <?php if ($profile_picture): ?> 
            <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="100">
        <?php else: ?>
            <p>ยังไม่มีรูปโปรไฟล์</p>
        <?php endif; ?>
    </p>
</body>
</html>

<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // ถ้ายังไม่ได้ล็อกอิน ส่งไปหน้า login
    exit();
}

require 'dbConfig.php'; // เชื่อมต่อฐานข้อมูล

/*
// ดึงข้อมูลผู้ใช้จาก session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>
*/
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลพื้นฐานจากตาราง users
$stmt = $conn->prepare("SELECT profile_picture, username, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profile_picture, $username, $email, $role);
$stmt->fetch();
$stmt->close();

// ตรวจสอบ role เพื่อดึงข้อมูลเพิ่มเติม
if ($role === 'student') {
    $stmt = $conn->prepare("SELECT score FROM students WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($score);
    $stmt->fetch();
    $stmt->close();
} elseif ($role === 'teacher') {
    $stmt = $conn->prepare("SELECT department FROM teachers WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($department);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .button-container {
            display: flex;
            flex-direction: column;
            /* แนวตั้ง */
            align-items: center;
            /* กลาง แนวนอน */
            /* ลบ margin ของ body */
        }

        button {
            margin: 10px auto;
            width: 50%;
        }

        .profile-icon {
            width: 60px;
            height: 60px;
            transition: width 0.3s ease, height 0.3s ease;
            margin: 10px 0;
            border-radius: 50%;
            background-image: url('profile.png');
            /* กำหนดภาพพื้นหลัง */
            background-size: cover;
            object-fit: cover;
            /* ให้รูปภาพพอดีกับขอบวงกลม */
            /* ปรับขนาดภาพให้พอดี */
            background-repeat: no-repeat;
            /* ป้องกันการซ้ำของภาพ */
            cursor: pointer;
            /* ระยะห่างจากด้านขวา */
            overflow: hidden;
            /* ตัดส่วนที่เกินออก */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="profile-info">
            <div>
            <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt=" " class="profile-icon">
            </div>
            <p><strong>ชื่อผู้ใช้:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>อีเมล:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>สถานะ:</strong> <?php echo htmlspecialchars($role === 'student' ? 'นักศึกษา' : 'ครู'); ?></p>

            <?php if ($role === 'student'): ?>
                <p><strong>คะแนนล่าสุด:</strong> <?php echo htmlspecialchars($score); ?></p>
            <?php elseif ($role === 'teacher'): ?>
                <p><strong>แผนก:</strong> <?php echo htmlspecialchars($department); ?></p>
            <?php endif; ?>
        </div>
        <div class="button-container">
            <button onclick="window.location.href='main.php'">กลับไปหน้าหลัก</button>
            <!-- <button class="red-button" onclick="window.location.href='logout.php'">ลงชื่อออก</button> -->
        </div>
    </div>
</body>

</html>
<?php
include 'dbConfig.php';

// รับค่าจาก URL
if (isset($_GET['username'])) {
    $username = $conn->real_escape_string($_GET['username']);

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT username, email, created_at FROM signup WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลผู้ใช้!";
        exit();
    }
} else {
    echo "ไม่พบข้อมูลผู้ใช้!";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h1>ยินดีต้อนรับ, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    <p>อีเมล: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>วันที่สมัคร: <?php echo htmlspecialchars($user['created_at']); ?></p>
    <a href="login.php">กลับไปหน้าเข้าสู่ระบบ</a>
</body>
</html>

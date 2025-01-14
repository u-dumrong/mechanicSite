<?php
// login.php
include '../dbConfig.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลในฐานข้อมูล
    $sql = "SELECT * FROM signup WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // ใช้ password_verify เพื่อตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // ถ้าล็อกอินสำเร็จ ส่งไปยังหน้าโปรไฟล์พร้อม username
            header("Location: profile.php?username=$username");
            exit();
        } else {
            echo "รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        echo "ไม่พบชื่อผู้ใช้!";
    }
}

?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">เข้าสู่ระบบ</button>
</form>

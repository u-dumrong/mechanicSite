<?php
session_start();

// ลบข้อมูลใน session ทั้งหมด
session_unset();

// ทำลาย session
session_destroy();

// ส่งผู้ใช้กลับไปยังหน้าล็อกอิน
header("Location: ../index.html");
exit();
?>

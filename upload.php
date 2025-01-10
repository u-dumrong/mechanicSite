<?php
session_start();
require 'dbConfig.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // ถ้ายังไม่ได้ล็อกอิน ส่งไปหน้า login
    exit();
}

$user_id = $_SESSION['user_id'];

// ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/"; // โฟลเดอร์สำหรับเก็บไฟล์
    $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบประเภทไฟล์
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($image_file_type, $allowed_types)) {
        echo "อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG และ GIF เท่านั้น.";
        exit();
    }

    // ตรวจสอบขนาดไฟล์ (สูงสุด 2MB)
    if ($_FILES['profile_picture']['size'] > 2 * 1024 * 1024) {
        echo "ไฟล์มีขนาดใหญ่เกินไป (สูงสุด 2MB).";
        exit();
    }

    // ย้ายไฟล์ไปยังโฟลเดอร์เป้าหมาย
    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
        $file_name = basename($_FILES['profile_picture']['name']); // ชื่อไฟล์ที่อัปโหลด

        // อัปเดตฐานข้อมูลเพื่อเก็บชื่อไฟล์รูปโปรไฟล์
        $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        $stmt->bind_param("si", $file_name, $user_id);
        $stmt->execute();
        $stmt->close();

        // รีไดเรกต์ไปที่หน้าโปรไฟล์
        header("Location: profile.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์.";
    }
} else {
    echo "ไม่ได้รับไฟล์รูปภาพ กรุณาเลือกไฟล์เพื่ออัปโหลด.";
}
?>

<?php
$time = $_GET['time'];
file_put_contents("timer.txt", $time * 60);

if (isset($_GET['time']) && is_numeric($_GET['time'])) {
    $time = (int)$_GET['time']; // แปลงพารามิเตอร์ให้เป็นตัวเลขจำนวนเต็ม

    if ($time > 0) { // ตรวจสอบว่าค่ามากกว่า 0
        file_put_contents("timer.txt", $time * 60); // เขียนเวลาในหน่วยวินาทีลงในไฟล์
        echo "Timer set to $time minutes."; // ยืนยันผลลัพธ์
    } else {
        echo "Invalid time value!"; // หากค่าผิดพลาด
    }
} else {
    echo "Time parameter is missing or invalid!"; // หากไม่มีพารามิเตอร์หรือค่าผิดพลาด
}
?>

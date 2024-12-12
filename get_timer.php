<?php
/*
$time = (int)file_get_contents("timer.txt");
$time -= 1;
file_put_contents("timer.txt", $time);
echo gmdate("i:s", $time);
*/

$timerFile = "timer.txt";

// ตรวจสอบว่าไฟล์ `timer.txt` มีอยู่หรือไม่
if (!file_exists($timerFile)) {
    die("Timer file not found!");
}

// อ่านค่าเวลาจากไฟล์
$time = (int)file_get_contents($timerFile);

// ลดเวลา 1 วินาที
if ($time > 0) {
    $time -= 1;
    file_put_contents($timerFile, $time); // เขียนค่ากลับไปที่ไฟล์
    echo gmdate("i:s", $time); // แสดงเวลาในรูปแบบ นาที:วินาที
} else {
    echo "หมดเวลา!"; // หากเวลาเป็น 0
}
?>

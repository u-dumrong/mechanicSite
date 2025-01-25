<?php
// ตรวจสอบการเชื่อมต่อกับฐานข้อมูล
$host = 'localhost';
$db = 'exam_system';
$user = 'root';
$pass = ''; // หรือรหัสผ่านที่ใช้งาน

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลเวลาเริ่มต้นและหมดเวลาจากฐานข้อมูล
$query = "SELECT * FROM exam_time ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$exam_time = null;

if ($result->num_rows > 0) {
    $exam_time = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งเวลา ข้อสอบ</title>
    <link rel="stylesheet" href="teacher_style.css">
</head>
<body>
    <div class="container">
        <h1>ตั้งเวลาเริ่มต้นและหมดเวลา ข้อสอบ</h1>
        
        <form id="examTimeForm" action="set_exam_time.php" method="POST">
            <label for="start_time">เวลาเริ่มสอบ:</label>
            <input type="datetime-local" id="start_time" name="start_time" required>
            <br><br>
            <label for="end_time">เวลาหมดสอบ:</label>
            <input type="datetime-local" id="end_time" name="end_time" required>
            <br><br>
            <input type="submit" value="ตั้งเวลา" id="setTimeButton">
        </form>

        <div id="currentTime">
            <h2>เวลาปัจจุบันของข้อสอบ:</h2>
            <p>เวลาเริ่มสอบ: <span id="currentStartTime">
                <?php echo $exam_time ? $exam_time['start_time'] : 'ยังไม่ได้ตั้งเวลา'; ?>
            </span></p>
            <p>เวลาหมดสอบ: <span id="currentEndTime">
                <?php echo $exam_time ? $exam_time['end_time'] : 'ยังไม่ได้ตั้งเวลา'; ?>
            </span></p>
        </div>
    </div>

    <script src="teacher_script.js"></script>
</body>
</html>

<?php
// $mysqli = new mysqli("localhost", "root", "", "quiz_db");
include 'dbConfig.php'; // เรียกการเชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $correct_option = $_POST["correct_option"];

    $stmt = $conn->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $question, $option1, $option2, $option3, $option4, $correct_option);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างข้อสอบ</title>
</head>
<body>
    <h1>สร้างข้อสอบ</h1>
    <form method="post">
        <label>คำถาม:</label><br>
        <input type="text" name="question" required><br>
        <label>ตัวเลือก:</label><br>
        <input type="text" name="option1" required><br>
        <input type="text" name="option2" required><br>
        <input type="text" name="option3" required><br>
        <input type="text" name="option4" required><br>
        <label>คำตอบที่ถูกต้อง (1-4):</label><br>
        <input type="number" name="correct_option" min="1" max="4" required><br><br>
        <button type="submit">บันทึกคำถาม</button>
    </form>

    <h2>เริ่มจับเวลา</h2>
    <form id="timer-form">
        <label>กำหนดเวลาสอบ (นาที):</label>
        <input type="number" id="time" min="1" required>
        <button type="button" onclick="startTimer()">เริ่มจับเวลา</button>
    </form>
    <p id="timer-display"></p>

    <script>
        function startTimer() {
            const time = document.getElementById("time").value;
            fetch("start_timer.php?time=" + time);
        }

        setInterval(() => {
            fetch("get_timer.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("timer").innerText = "เวลาที่เหลือ: " + data;

                    // จัดการเมื่อหมดเวลา
                    if (data === "หมดเวลา!") {
                        alert("หมดเวลา!");
                        document.querySelector("form").style.display = "none";
                    }
                })
                .catch(error => console.error("เกิดข้อผิดพลาด:", error));
        }, 1000);
    </script>
</body>
</html>

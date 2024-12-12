<?php
// $mysqli = new mysqli("localhost", "root", "", "quiz_db");
// $result = $mysqli->query("SELECT * FROM questions");
include 'dbConfig.php'; // เรียกการเชื่อมต่อฐานข้อมูล
$result = $conn->query("SELECT * FROM questions");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ทำข้อสอบ</title>
</head>
<body>
    <h1>ทำข้อสอบ</h1>
    <form method="post" action="submit.php">
        <?php while ($row = $result->fetch_assoc()): ?>
            <p><?= $row["question"] ?></p>
            <input type="radio" name="answer[<?= $row["id"] ?>]" value="1"> <?= $row["option1"] ?><br>
            <input type="radio" name="answer[<?= $row["id"] ?>]" value="2"> <?= $row["option2"] ?><br>
            <input type="radio" name="answer[<?= $row["id"] ?>]" value="3"> <?= $row["option3"] ?><br>
            <input type="radio" name="answer[<?= $row["id"] ?>]" value="4"> <?= $row["option4"] ?><br>
        <?php endwhile; ?>
        <button type="submit">ส่งคำตอบ</button>
    </form>

    <p id="timer"></p>

    <script>
        setInterval(() => {
            fetch("get_timer.php")
                .then(response => response.text())
                .then(data => document.getElementById("timer").innerText = "เวลาที่เหลือ: " + data);
        }, 1000);
    </script>
</body>
</html>

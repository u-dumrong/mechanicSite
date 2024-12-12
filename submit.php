<?php
// $mysqli = new mysqli("localhost", "root", "", "quiz_db");
include 'dbConfig.php'; // เรียกการเชื่อมต่อฐานข้อมูล

$answers = $_POST['answer'];
$score = 0;

foreach ($answers as $question_id => $selected_option) {
    $result = $conn->query("SELECT correct_option FROM questions WHERE id = $question_id");
    $correct_option = $result->fetch_assoc()["correct_option"];
    if ($correct_option == $selected_option) {
        $score++;
    }
}

echo "คะแนนของคุณ: $score/" . count($answers);
?>

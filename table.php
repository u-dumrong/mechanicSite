<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin"; // ชื่อฐานข้อมูล

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT u.username, u.profile_picture, s.score 
        FROM users u
        JOIN students s ON u.id = s.user_id
        WHERE u.role = 'student'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 50px auto;
            border: 2px solid black; /* เส้นรอบขอบตาราง */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid black; /* เส้นระหว่างแถวและคอลัมน์ */
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Information</h2>

<table>
    <thead>
        <tr>
            <th>Profile Picture</th>
            <th>Username</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='uploads/" . $row['profile_picture'] . "' alt='Profile Picture'></td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>

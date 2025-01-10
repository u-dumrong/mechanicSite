<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Hashed Password</title>
</head>
<body>
    <h1>Generate Hashed Password</h1>
    <form method="POST" action="">
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Generate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // รับค่ารหัสผ่านจากฟอร์ม
        $password = $_POST["password"];
        
        // สร้าง hashed password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // แสดงผล hashed password
        echo "<h3>Hashed Password:</h3>";
        echo "<p><code>$hashed_password</code></p>";
    }
    ?>
</body>
</html>

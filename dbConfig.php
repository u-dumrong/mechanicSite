<?php
$host = "localhost";  // MySQL host
$username = "root";   // MySQL username (default in XAMPP is 'root')
$password = "";       // MySQL password (default in XAMPP is empty)
$dbname = "admin"; // Name of your database

// Create connection ส่งข้อมูลหา MySql
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection ถ้าส่งข้อมูลไม่ได้จะแจ้งข้อผิดพลาด 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$host = "localhost";  // MySQL host
$username = "root";   // MySQL username (default in XAMPP is 'root')
$password = "";       // MySQL password (default in XAMPP is empty)
$dbname = "admin"; // Name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

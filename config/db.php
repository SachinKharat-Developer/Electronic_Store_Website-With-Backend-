<?php
$host = "localhost"; 
$user = "root"; // Default XAMPP user
$pass = ""; // Default password (empty)
$dbname = "eshop_db"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

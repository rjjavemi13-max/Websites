<?php
// Database connection file for Zenith Legal Advocates
// Database: zenithlegal

$db_host = 'localhost';      // Usually 'localhost'
$db_user = 'root';           // Default XAMPP username
$db_pass = '';               // Default XAMPP password (empty)
$db_name = 'zenithlegal';    // Database name

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");

?>

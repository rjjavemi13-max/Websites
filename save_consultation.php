<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zenithlegal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

// Set charset to utf8
$conn->set_charset("utf8");

// Get form data
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo json_encode(array("status" => "error", "message" => "All fields are required"));
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("status" => "error", "message" => "Invalid email format"));
    exit;
}

// Insert data into database
$sql = "INSERT INTO legal_services_consultation_log (name, email, phone, subject, message, created_at) 
        VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(array("status" => "error", "message" => "Prepare failed: " . $conn->error));
    exit;
}

$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Consultation request received. We will contact you shortly."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error saving consultation: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>

<?php
// Form submission handler for Zenith Legal Advocates contact form
header('Content-Type: application/json');

// Include database connection
require_once 'db_connect.php';

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data and sanitize
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate form fields
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required';
    }
    
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit;
    }
    
    // Prepare and execute SQL statement
    $sql = "INSERT INTO consultations (name, email, phone, subject, message, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $conn->error
        ]);
        exit;
    }
    
    // Bind parameters
    $stmt->bind_param('sssss', $name, $email, $phone, $subject, $message);
    
    // Execute statement
    if ($stmt->execute()) {
        // Send success response
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Consultation request submitted successfully. We will contact you soon!'
        ]);
    } else {
        // Send error response
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error submitting form: ' . $stmt->error
        ]);
    }
    
    $stmt->close();
    $conn->close();
    
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
}
?>

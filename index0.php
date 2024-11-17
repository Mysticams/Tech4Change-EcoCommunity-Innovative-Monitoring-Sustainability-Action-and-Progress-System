<?php
// Include the analytics tracking code
require_once 'database.php';

// Collect analytics data for this page
$page = basename($_SERVER['PHP_SELF']);  // Current page name
$ipAddress = $_SERVER['REMOTE_ADDR'];    // Visitor's IP address
$userAgent = $_SERVER['HTTP_USER_AGENT']; // Visitor's browser info

// Insert data into the database
$stmt = $conn->prepare("INSERT INTO analytics (page, ip_address, user_agent) VALUES (?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("sss", $page, $ipAddress, $userAgent);
    $stmt->execute();
    $stmt->close();
} else {
    error_log("Failed to insert analytics data: " . $conn->error);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<body>
    <h1>About Us</h1>
    <p>Welcome to the about page! This page is being tracked for analytics purposes.</p>
</body>
</html>

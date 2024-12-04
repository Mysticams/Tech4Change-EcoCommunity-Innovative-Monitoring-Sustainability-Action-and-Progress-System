<?php

$conn = mysqli_connect("localhost", "root", "", "finalproj");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO user (username, role, email, is_deleted, created_at) 
            VALUES ('$username', '$role', '$email', 0, NOW())";

    if (mysqli_query($conn, $sql)) {
        // Redirect to userlist.php 
        header("Location: userlist.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


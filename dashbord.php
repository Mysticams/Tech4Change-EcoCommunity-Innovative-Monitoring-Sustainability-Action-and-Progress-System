<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "! Your role is: " . htmlspecialchars($_SESSION['role']);
?>

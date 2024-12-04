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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.jpg" alt="logo">
                </span>
                <div class="text header-text">
                    <span class="name">Tech4Change:</span>
                    <span class="profession">Ecommunity</span>
                </div>
            </div>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="nav-link welcome-admin">
                    <span class="text">
                        <h3>Welcome, Admin!</h3>
                    </span>
                </li>
                <div class="cut-line"></div>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="adminMain.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../admin/profile.php">
                            <i class='bx bxs-user-circle icon'></i>
                            <span class="text nav-text">Accounts</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../admin/userlist.php">
                            <i class='bx bx-list-ul icon'></i>
                            <span class="text nav-text">User List</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../admin/admin_chat.php">
                            <i class='bx bxs-message-dots icon'></i>
                            <span class="text nav-text">Forum</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../admin/projects.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Projects</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="buttom-content">
                <li class="nav-link">
                    <a href="../webpageplain/header.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>   

    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
           
        }

        .main-profile-content {
            display: center;
     
          
        }

        .header-wrapper-profile {
            margin-bottom: 20px;
        }

        .header-profile-title h2 {
            margin: 0;
            font-size: 24px;
        }

        .header-profile-title a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
            display: inline-block;
        }

        .cut-line1 {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            display: center;
            width: 50%;
            padding: 4px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <section class="main-profile-content">
        <div class="header-wrapper-profile">
            <div class="header-profile-title">
                <h2>Account Settings</h2>
                <a>Manage Accounts</a>
            </div>
        </div>

        <div class="cut-line1"></div>

        <h3>Add Users</h3>
        <form action="profile.php" method="post">
            <div>
                <label for="new-username">Username:</label>
                <input type="text" id="new-username" name="username" placeholder="Enter Username" required>
            </div>
            <div>
                <label for="new-role">Role:</label>
                <select id="new-role" name="role" required>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div>
                <label for="new-email">Email:</label>
                <input type="email" id="new-email" name="email" placeholder="Enter Email" required>
            </div>
            <button type="submit">Save</button>
        </form>
    </section>
</body>
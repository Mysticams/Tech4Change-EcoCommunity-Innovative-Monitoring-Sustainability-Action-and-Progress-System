<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "finalproj"; 

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
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
                <!-- Welcome Message -->
                <li class="nav-link welcome-admin">
                    <span class="text">
                        <h3>Welcome, Admin!</h3>
                    </span>
                </li>

                <div class="cut-line"></div>

                <ul class="menu-links">
                    <!-- Dashboard Link -->
                    <li class="nav-dash">
                        <a href=""> 
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Profile Link -->
                    <li class="nav-link">
                        <a href="../admin/profile.php">
                            <i class='bx bxs-user-circle icon'></i>
                            <span class="text nav-text">Accounts</span>
                        </a>
                    </li>

                    <!-- User List Link -->
                    <li class="nav-link">
                        <a href="../admin/userlist.php">
                            <i class='bx bx-list-ul icon'></i>
                            <span class="text nav-text">User List</span>
                        </a>
                    </li>

                    <!-- Messages Link -->
                    <li class="nav-link">
                        <a href="../admin/admin_chat.php">
                            <i class='bx bxs-message-dots icon'></i>
                            <span class="text nav-text">Forum</span>
                        </a>
                    </li>

                    <!-- Projects -->
                    <li class="nav-link">
                        <a href="../admin/projects.php">
                             <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Projects</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Logout Button -->
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

        <!-- Main Content Section -->
            <section class="main-content">
                <div class="header-wrapper">
                    <div class="header-title">
                        <span>Primary</span>
                        <h2>Dashboard</h2>
                    </div>
                </div>

            <div class="dashboard-content">
                <p>Here you can monitor all users list, task list, deletes and feedback.</p>
            </div>

            <div class="grid-container">
                <div class="card">   
                    <i class='bx bx-user card-icon'></i>
                    <h2>Total Users</h2>

            <?php
                    // total users
                    $dash_user_query = "SELECT * FROM `user`";
                    $dash_user_query_run = mysqli_query($con, $dash_user_query);

            if ($dash_user_query_run) {
                $user_total = mysqli_num_rows($dash_user_query_run);

                if ($user_total > 0) {
                    echo '<h1 class="mb-0">' . $user_total . '</h1>';
                } else {
                    echo '<h1 class="mb-0">0</h1>';
                }
            } else {
                echo '<h1 class="mb-0">Error</h1>';
            }
            ?>
        </div>

        <!--PROJECTS PERCENT-->
        <div class="card">
            <i class='bx bx-task card-icon'></i>
            <h2>Project List</h2>
        
            <?php
                    // total projects 
                    $dash_projects_query = "SELECT * FROM `projects`";
                    $dash_projects_query_run = mysqli_query($con, $dash_projects_query);


            if ($dash_projects_query_run) {
                $projects_total = mysqli_num_rows($dash_projects_query_run);

                if ($projects_total > 0) {
                    echo '<h1 class="mb-0">' . $projects_total . '</h1>';
                } else {
                    echo '<h1 class="mb-0">No Data</h1>';
                }
            } else {
                echo '<h1 class="mb-0">Query Error</h1>';
            }
            ?>
        </div>

        <div class="card">
    <i class='bx bxs-trash card-icon'></i>
    <h2>Trash</h2>

<?php

    // Count the number of deleted users
    $trash_query = "SELECT COUNT(*) as trash_count FROM user WHERE is_deleted = 1";
    $trash_query_run = mysqli_query($con, $trash_query);

    if ($trash_query_run) {
        $trash_row = mysqli_fetch_assoc($trash_query_run);
        $trash_count = $trash_row['trash_count'];

        echo '<h1>' . ($trash_count > 0 ? $trash_count : '0') . '</h1>';
    } else {
        echo '<h1>Query Error</h1>';
    }
    ?>
</div>

            <div class="card">
                <i class='bx bxs-tree card-icon'></i> 
                <h2>Status</h2>

             <!--total status-->
             <?php
             $dash_moods_query = "SELECT * FROM `moods`";
                    $dash_moods_query_run = mysqli_query($con, $dash_moods_query);

            if ($dash_moods_query_run) {
                $moods_total = mysqli_num_rows($dash_moods_query_run);

                if ($moods_total > 0) {
                    echo '<h1 class="mb-0">' . $moods_total . '</h1>';
                } else {
                    echo '<h1 class="mb-0">No Data</h1>';
                }
            } else {
                echo '<h1 class="mb-0">Query Error</h1>';
            }
            ?>
        </div>
    </div>

        <!-- Archive of Deleted or Restored Users -->
<div class="recent-activity">
    <i class='bx bx-time-five activity-icon'></i>
    <p>Archive</p>
</div>

<div class="grid-recent-container">
    <div class="grid-recent-header">Id</div>
    <div class="grid-recent-header">Role</div>
    <div class="grid-recent-header">Username</div>
    <div class="grid-recent-header">Email</div>
    <div class="grid-recent-header">Date</div>
    <div class="grid-recent-header">Actions</div>


    <?php
    // Action for restore or delete

    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = intval($_GET['id']); 
        $action = $_GET['action'];
        
        if ($action === 'restore') {

            // Restore user
            $sql = "UPDATE user SET is_deleted = 0 WHERE id = $id";
            mysqli_query($con, $sql); 
        } elseif ($action === 'delete') {

            // Permanently delete user
            $sql = "DELETE FROM user WHERE id = $id";
            mysqli_query($con, $sql); 
        }
    }

    // Fetch and display archived users
    $archive_query = "SELECT id, role, username, email, DATE_FORMAT(created_at, '%Y-%m-%d') as 
    formatted_date FROM user WHERE is_deleted = 1";
    $archive_query_run = mysqli_query($con, $archive_query);

    if ($archive_query_run && mysqli_num_rows($archive_query_run) > 0) {
        while ($row = mysqli_fetch_assoc($archive_query_run)) {
            echo "<div class='grid-recent-item'>{$row['id']}</div>";
            echo "<div class='grid-recent-item'>{$row['role']}</div>";
            echo "<div class='grid-recent-item'>{$row['username']}</div>";
            echo "<div class='grid-recent-item'>{$row['email']}</div>";
            echo "<div class='grid-recent-item'>{$row['formatted_date']}</div>";
            echo "<div class='grid-recent-item'>
                    <a href='adminMain.php?action=restore&id={$row['id']}' class='icon-button restore-icon'>
                        <i class='bx bx-archive-in'></i>
                    </a>
                    <a href='adminMain.php?action=delete&id={$row['id']}' class='icon-button deleted-icon'>
                        <i class='bx bxs-trash'></i>
                    </a>
                </div>";
        }
    } else {
        echo "<div class='grid-found-item'>No Users found.</div>";
    }
    ?>
</div>

<style>

.icon-button {
    text-decoration: none;
    font-size: 20px;
    margin: 0 5px;
    padding: 5px;
    color: #555;
    transition: color 0.3s ease;
}

.restore-icon:hover {
    background-color: #5D9C59;
    color: #F6F5FF;
}

.deleted-icon:hover {
    background-color: #f44336;
    color: #F6F5FF;
}

.restore-icon,
.deleted-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #707070;
    width: 30px;
    height: 30px;
    border-radius: 2px;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.grid-found-item {
    justify-content: center;

}
</style>



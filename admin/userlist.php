<?php
$conn = mysqli_connect("localhost", "root", "", "finalproj");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set default sort options
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
$sort_order = isset($_GET['sort_order']) && in_array($_GET['sort_order'], 
['asc', 'desc']) ? $_GET['sort_order'] : 'asc';

// Sorting column
$valid_sort_columns = ['id', 'username', 'created_at'];
if (!in_array($sort_by, $valid_sort_columns)) {
    $sort_by = 'id';
}

$sql = "SELECT id, role, username, email, DATE(created_at) AS created_at 
        FROM user 
        WHERE is_deleted = 0 
        ORDER BY $sort_by $sort_order";
$result = mysqli_query($conn, $sql);

// Handle delete 
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update the is_deleted column to 1 
    $delete_sql = "UPDATE user SET is_deleted = 1 WHERE id = $id";

    if (mysqli_query($conn, $delete_sql)) {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Tech4Change</title>
</head>

<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                <img src="img/tech4.jpg" alt="logo">
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

    <section class="main-userlist-content">
        <div class="header-wrapper-userlist">
            <div class="header-title-userlist">
                <span>User List</span>
                <h2>User Management</h2>
            </div>
        </div>

        <div class="sort-filter">
            <form method="GET" action="">
                <select name="sort_by" class="sort-dropdown">
                    <option value="id">Id</option>
                    <option value="created_at">Date</option>
                    <option value="username">Username</option>
                </select>
                <select name="sort_order" class="sort-dropdown">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button type="submit" class="sort-btn">Sort</button>
            </form>
        </div>


        <div class="export-section">
            <button class="print-btn" onclick="window.print();">Print</button>
        </div>

        <div class="grid-userlist-container">
            <div class="grid-header">Id</div>
            <div class="grid-header">Role</div>
            <div class="grid-header">Username</div>
            <div class="grid-header">Email</div>
            <div class="grid-header">Date</div>
            <div class="grid-header">Actions</div>

            <?php
            // Check users
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='grid-item'>{$row['id']}</div>";
                    echo "<div class='grid-item'>{$row['role']}</div>";
                    echo "<div class='grid-item'>{$row['username']}</div>";
                    echo "<div class='grid-item'>{$row['email']}</div>";
                    echo "<div class='grid-item'>{$row['created_at']}</div>";
                    echo "<div class='grid-item icon'>
                <a href='userlist.php?id={$row['id']}' class='delete-button'>
                   <i class='bx bx-message-alt-minus'></i>
                </a>
                <a href='edit.php?id={$row['id']}' class='edit-button'>
                    <i class='bx bxs-edit'></i>
                </a>
            </div>";
                }
            } else {
                echo "No users found.";
            }

            mysqli_close($conn);
            ?>

        </div>
        </div>
    </section>
</body>

</html>
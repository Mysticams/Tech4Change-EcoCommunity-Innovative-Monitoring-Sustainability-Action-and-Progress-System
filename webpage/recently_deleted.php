<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

// Initialize the database connection and project object
$db = (new Database())->connect();
$project = new Project($db);

// Fetch recently deleted projects (within the last 30 days)
$recentlyDeletedProjects = $project->readRecentlyDeleted(30); // You can adjust the number of days

// Check if there are any recently deleted projects
if ($recentlyDeletedProjects && count($recentlyDeletedProjects) > 0) {
    echo "<h1>Recently Deleted Projects</h1>";

    // Loop through each recently deleted project and display its details
    foreach ($recentlyDeletedProjects as $proj) {
        $title = htmlspecialchars($proj['title']);
        $progress = htmlspecialchars($proj['progress']);
        $status = htmlspecialchars($proj['status']);
        $deletedAt = htmlspecialchars($proj['deleted_at']);
        $id = htmlspecialchars($proj['id']);
        
        // Output project details with options to Restore or Permanently Delete
        echo "<div>";
        echo "<p><strong>{$title}</strong> - Progress: {$progress}% - Status: {$status} - Deleted At: {$deletedAt}</p>";
        echo "<a href='restore.php?id={$id}'>Restore</a>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No recently deleted projects found.</p>";
}
?>

<body> 
<a href="adminDashboard.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>

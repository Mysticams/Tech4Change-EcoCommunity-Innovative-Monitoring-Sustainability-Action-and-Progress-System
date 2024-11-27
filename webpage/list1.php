<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

// Initialize the database connection and project object
$db = (new Database())->connect();
$project = new Project($db);

// Fetch all projects from the database
$projects = $project->read();

// Check if projects exist and if there are no duplicates
if ($projects && count($projects) > 0) {
    echo "<h1>Project List</h1>";

    // Initialize an array to track seen project IDs (avoid duplicates)
    $seenProjects = [];

    // Loop through each project and display its details
    foreach ($projects as $proj) {
        // Ensure that we aren't displaying the same project more than once
        if (in_array($proj['id'], $seenProjects)) {
            continue; // Skip if the project has already been displayed
        }

        // Mark this project as seen
        $seenProjects[] = $proj['id'];

        // Use htmlspecialchars to escape special characters for security
        $title = htmlspecialchars($proj['title']);
        $progress = htmlspecialchars($proj['progress']);
        $status = htmlspecialchars($proj['status']);
        $id = htmlspecialchars($proj['id']);
        
        // Output project details with Update and Delete links
        echo "<div>";
        echo "<p><strong>{$title}</strong> - Progress: {$progress}% - Status: {$status}</p>";
        echo "<a href='update.php?id={$id}'>Update</a> | ";
        echo "<a href='delete.php?id={$id}'>Delete</a>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No projects found.</p>";
}
?>

<body> 
<a href="adminDashboard.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>

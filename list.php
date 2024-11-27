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
        echo "<div class='project-card'>";
        echo "<div class='card-header'>";
        echo "<h2>{$title}</h2>";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<p><strong>Progress:</strong> {$progress}%</p>";
        echo "<p><strong>Status:</strong> {$status}</p>";
        echo "</div>";
        echo "<div class='card-footer'>";
        echo "<a href='update.php?id={$id}' class='btn-update'>Update</a>";
        echo "<a href='delete.php?id={$id}' class='btn-delete'>Delete</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No projects found.</p>";
}
?>

<body> 
    <div class="cta-button">
        <a href="userDashboard.php">
            <button class="return-button">Return</button>
        </a>
    </div>
</body>

<style>
    /* General Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background: #f2f8f8;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
    }

    h1 {
        font-size: 2.5rem;
        color: #2f4f4f;
        margin-bottom: 40px;
        text-align: center;
        font-weight: 600;
    }

    /* Project Card Styling */
    .project-card {
        background: #fff;
        width: 100%;
        max-width: 650px;
        margin-bottom: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background-color: #008080; /* Teal */
        color: white;
        padding: 20px;
        text-align: center;
    }

    .card-header h2 {
        font-size: 1.8rem;
        margin: 0;
    }

    .card-body {
        padding: 20px;
        color: #555;
    }

    .card-body p {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    /* Footer with Action Links */
    .card-footer {
        background-color: #f9f9f9;
        padding: 10px;
        text-align: center;
    }

    .card-footer a {
        font-size: 1rem;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin: 0 10px;
        transition: all 0.3s ease;
    }

    .btn-update {
        background-color: #66c2b3; /* Light Teal */
        color: white;
    }

    .btn-update:hover {
        background-color: #4c9e92;
    }

    .btn-delete {
        background-color: #e57373; /* Soft Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #d32f2f;
    }

    /* Return Button */
    .cta-button {
        margin-top: 50px;
        text-align: center;
    }

    .return-button {
        background-color: #66c2b3; /* Light Teal */
        color: white;
        padding: 12px 24px;
        font-size: 1.1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .return-button:hover {
        background-color: #4c9e92;
        transform: scale(1.05);
    }
</style>

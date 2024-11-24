<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->connect();
    $project = new Project($db);

    $title = $_POST['title'];
    $description = $_POST['description'];

    // Create project with default progress (0%)
    if ($project->create($title, $description)) {
        echo "Project Created!";
    } else {
        echo "Error creating project.";
    }
}
?>

<h1>Create Project</h1>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>
    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>
    <button type="submit">Create</button>
</form>
<body>
<a href="userDashboard.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>
<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

if (isset($_GET['id'])) {
    $db = (new Database())->connect();
    $project = new Project($db);
    if ($project->delete($_GET['id'])) {
        echo "Project marked as deleted.";
    } else {
        echo "Error deleting project.";
    }
}
?>

<body>
<a href="index.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>
<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

if (isset($_GET['id'])) {
    $db = (new Database())->connect();
    $project = new Project($db);

    // Restore the project by setting deleted_at to NULL
    $id = $_GET['id'];
    $project->restore($id);

    // Redirect back to the recently deleted projects page
    header("Location: recently_deleted.php");
    exit();
}
?>

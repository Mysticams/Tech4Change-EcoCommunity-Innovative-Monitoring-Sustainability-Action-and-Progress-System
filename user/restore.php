<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

if (isset($_GET['id'])) {
    $db = (new Database())->connect();
    $project = new Project($db);

    // Restore the project by setting deleted_at 
    $id = $_GET['id'];
    $project->restore($id);

    header("Location: recently_deleted.php");
    exit();
}
?>

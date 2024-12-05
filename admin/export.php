<?php
require_once 'Database.php';
require_once 'crudOperations.php';

$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

if (isset($_POST['export_csv'])) {
    $project->exportProgressReportAsCSV();
}

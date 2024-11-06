<?php
include 'db.php';

$id = $_GET['id'];
$deleted_at = date('Y-m-d H:i:s');

$sql = "UPDATE eco_community SET deleted_at='$deleted_at' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
?>

<?php
include 'db.php';

$sql = "SELECT id, name, email, action_description, progress_status, created_at, deleted_at FROM eco_community WHERE deleted_at IS NOT NULL";
$result = $conn->query($sql);
?>

<a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
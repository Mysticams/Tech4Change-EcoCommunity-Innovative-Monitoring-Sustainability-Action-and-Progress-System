<?php
include 'db.php';

$sql = "SELECT id, name, email, action_description, progress_status, created_at, deleted_at FROM eco_community WHERE deleted_at IS NOT NULL";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Deleted Actions</title>
</head>

<body>
    <h2>Deleted Actions List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action Description</th>
            <th>Progress Status</th>
            <th>Created At</th>
            <th>Deleted At</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["action_description"] . "</td>";
                echo "<td>" . $row["progress_status"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["deleted_at"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
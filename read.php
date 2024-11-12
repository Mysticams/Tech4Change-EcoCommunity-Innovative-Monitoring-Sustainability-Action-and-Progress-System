<?php
include 'db.php';

$sql = "SELECT id, name, email, action_description, progress_status, created_at FROM eco_community WHERE deleted_at IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Actions</title>
</head>

<body>
    <h2>Actions List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action Description</th>
            <th>Progress Status</th>
            <th>Created At</th>
            <th>Actions</th>
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
                echo '<td><a href="update.php?id=' . $row["id"] . '">Update</a> | <a href="delete.php?id=' . $row["id"] . '">Delete</a></td>';
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>

    <a href="index.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>

</html>
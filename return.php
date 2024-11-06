<?php
include 'db.php';

// Initialize the project variable
$project = [
    'id' => '',
    'project_name' => '',
    'description' => '',
    'start_date' => '',
    'end_date' => '',
    'status' => ''
];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ensure $id is numeric to prevent SQL injection
    if (is_numeric($id)) {
        $sql = "SELECT * FROM sustainability_projects WHERE id='$id'";
        $result = $conn->query($sql);

        // Check if the query was successful and if a project was found
        if ($result && $result->num_rows > 0) {
            $project = $result->fetch_assoc(); // Fetch project data
        } else {
            echo "No project found with the given ID.";
            exit(); // Exit if no project found
        }
    } else {
        echo "Invalid project ID.";
        exit();
    }
} else {
    echo "Project ID not provided.";
    exit();
}

if (isset($_POST['submit'])) {
    // Ensure that the ID is retained for the update process
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    // Update query (corrected table name)
    $sql = "UPDATE sustainability_projects SET 
                project_name='$name', 
                description='$description', 
                start_date='$start_date', 
                end_date='$end_date', 
                status='$status' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Project updated successfully<br>";
        echo '<a href="index.php">Return to Home</a>'; // Link to home page
    } else {
        echo "Error updating project: " . $conn->error;
    }
}
?>

<!-- Update form with a hidden field to pass the project ID -->
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($project['id']); ?>"> <!-- Hidden field for ID -->
    Project Name: <input type="text" name="name" value="<?php echo htmlspecialchars($project['project_name']); ?>" required><br>
    Description: <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea><br>
    Start Date: <input type="date" name="start_date" value="<?php echo htmlspecialchars($project['start_date']); ?>" required><br>
    End Date: <input type="date" name="end_date" value="<?php echo htmlspecialchars($project['end_date']); ?>" required><br>
    Status: <input type="text" name="status" value="<?php echo htmlspecialchars($project['status']); ?>" required><br>
    <input type="submit" name="submit" value="Update Project">
</form>

<!-- Return to Home link -->
<a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
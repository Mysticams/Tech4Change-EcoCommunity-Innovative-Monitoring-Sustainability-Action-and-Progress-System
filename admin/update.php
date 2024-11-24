<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

// Initialize the project variable
$project = null;
$proj = null;

// Always instantiate the Database and Project objects
$db = (new Database())->connect();
$project = new Project($db);

// Check if 'id' is passed in the URL (via GET)
if (isset($_GET['id'])) {
    $proj = $project->readSingle($_GET['id']); // Fetch project by ID
}

// Check if form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Get form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $status = $_POST['status'];

    // Call the update method of Project class
    if ($project->update($id, $title, $description, $progress, $status)) {
        echo "Project Updated!";
    } else {
        echo "Error updating project.";
    }
}
?>

<h1>Update Project</h1>

<?php if ($proj): // Only display the form if project is found ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($proj['id']) ?>">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($proj['title']) ?>" required><br>
        <label>Description:</label><br>
        <textarea name="description" required><?= htmlspecialchars($proj['description']) ?></textarea><br>
        <label>Progress:</label><br>
        <input type="number" name="progress" value="<?= htmlspecialchars($proj['progress']) ?>" min="0" max="100"><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="active" <?= $proj['status'] == 'active' ? 'selected' : '' ?>>Active</option>
            <option value="progress" <?= $proj['status'] == 'progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="completed" <?= $proj['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
        </select><br>
        <button type="submit">Update</button>
    </form>
    <a href="adminDashboard.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
<?php else: ?>
    <p>Project not found or invalid ID.</p>
<?php endif; ?>

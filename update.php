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
        echo "<div class='alert success'>Project Updated!</div>";
    } else {
        echo "<div class='alert error'>Error updating project.</div>";
    }
}
?>

<h1>Update Project</h1>

<?php if ($proj): // Only display the form if project is found ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($proj['id']) ?>">
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($proj['title']) ?>" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?= htmlspecialchars($proj['description']) ?></textarea><br>

        <label for="progress">Progress (%):</label><br>
        <input type="number" id="progress" name="progress" value="<?= htmlspecialchars($proj['progress']) ?>" min="0" max="100"><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status">
            <option value="active" <?= $proj['status'] == 'active' ? 'selected' : '' ?>>Active</option>
            <option value="progress" <?= $proj['status'] == 'progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="completed" <?= $proj['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
        </select><br>

        <button type="submit" class="submit-button">Update</button>
    </form>

    <a href="userDashboard.php" class="cta-button">
        <button class="return-button">Return</button>
    </a>
<?php else: ?>
    <p>Project not found or invalid ID.</p>
<?php endif; ?>

<!-- Styles -->
<style>
    /* General Body Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        box-sizing: border-box;
    }

    h1 {
        font-size: 2.5rem;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
    }

    /* Form Styling */
    form {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 500px;
        margin-bottom: 30px;
    }

    form input, form textarea, form select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    form input:focus, form textarea:focus, form select:focus {
        border-color: #66c2b3;
        outline: none;
    }

    .submit-button {
        background-color: #66c2b3;
        color: white;
        padding: 12px 20px;
        font-size: 1.1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #4c9e92;
    }

    /* Alerts */
    .alert {
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Return Button */
    .cta-button {
        text-align: center;
        width: 100%;
    }

    .return-button {
        background-color: #FF00BF;
        color: white;
        padding: 12px 24px;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .return-button:hover {
        background-color: #d600a0;
    }
</style>

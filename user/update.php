<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$db = (new Database())->connect();
$project = new Project($db);

// Check if an id is provided via GET request
$id = $_GET['id'] ?? null;
$proj = null; // Initialize $proj to avoid undefined variable warning

if ($id) {
    // Use the readSingle method to fetch the project
    $proj = $project->readSingle($id);

    if (!$proj) {
        // If project is not found, show an alert and exit
        echo "<script>Swal.fire('Project not found!', '', 'error');</script>";
        exit;
    }
} else {
    // If no ID is provided, show an alert and exit
    echo "<script>Swal.fire('Invalid project ID!', '', 'error');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to update the project
    $title = $_POST['title'] ?? '';
    $progress = $_POST['progress'] ?? 0;

    // Update project in the database
    $updateResult = $project->update($id, $title, $progress); // Assuming you have an update method in CrudOperations.php

    // Redirect with success or failure message
    if ($updateResult) {
        header('Location: list.php?success=true');
        exit;
    } else {
        header('Location: list.php?success=false');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2980b9, #6dd5ed); /* Blue gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #fff;
            font-size: 2rem;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        label {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Update Project</h1>

    <?php if ($proj): ?>
        <!-- Only show this form if project data is retrieved successfully -->
        <form action="update.php?id=<?php echo $proj['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($proj['id']); ?>">

            <label for="title">Project Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($proj['title']); ?>" required>

            <label for="progress">Progress (%):</label>
            <input type="number" id="progress" name="progress" value="<?php echo htmlspecialchars($proj['progress']); ?>" required min="0" max="100">

            <button type="submit">Update Project</button>
        </form>
    <?php else: ?>
        <!-- If no project is found, show an error message -->
        <p class="error-message">Project not found.</p>
    <?php endif; ?>
</div>

<script>
    // SweetAlert2 Success message if project updated successfully
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        Swal.fire({
            title: 'Project Updated!',
            text: 'Your project was updated successfully.',
            icon: 'success',
            confirmButtonText: 'Okay'
        });
    <?php endif; ?>

    // SweetAlert2 Error message if project not found or invalid
    <?php if (isset($_GET['success']) && $_GET['success'] == 'false'): ?>
        Swal.fire({
            title: 'Error!',
            text: 'There was an issue updating the project.',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    <?php endif; ?>
</script>

</body>
</html>

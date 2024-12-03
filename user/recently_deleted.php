<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$db = (new Database())->connect();
$project = new Project($db);

// Fetch recently deleted projects (last 30 days)
$recentlyDeletedProjects = $project->readRecentlyDeleted(30);

// Handle restore request via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restore_id'])) {
    $restoreResult = $project->restoreProject($_POST['restore_id']);
    if ($restoreResult) {
        echo json_encode(['status' => 'success', 'message' => 'Project restored successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to restore project.']);
    }
    exit; // End the script execution after responding to AJAX
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently Deleted Projects</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6e7bff, #4e73df);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Project List Container */
        .project-list-container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .project-list-container h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }

        .project-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .project-item:hover {
            background-color: #f0f0f0;
        }

        .project-title {
            font-size: 1.2rem;
            color: #333;
        }

        .deleted-at {
            font-size: 1rem;
            color: #ff4e4e;
        }

        .no-projects {
            font-size: 1.2rem;
            color: #777;
            margin-top: 20px;
        }

        /* Button Styles */
        .back-button {
            background-color: #4e73df;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .back-button:hover {
            background-color: #3b5bbf;
        }

        .restore-button {
            background-color: #28a745;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .restore-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1>Recently Deleted Projects</h1>

    <div class="project-list-container">
        <h2>Deleted Projects in the Last 30 Days</h2>

        <?php if ($recentlyDeletedProjects && count($recentlyDeletedProjects) > 0): ?>
            <ul>
                <?php foreach ($recentlyDeletedProjects as $project): ?>
                    <li class="project-item">
                        <div class="project-title">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </div>
                        <div class="deleted-at">
                            Deleted on: <?php echo htmlspecialchars($project['deleted_at']); ?>
                        </div>

                        <!-- Restore Button -->
                        <button class="restore-button" onclick="restoreProject(<?php echo $project['id']; ?>)">Restore</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-projects">No recently deleted projects found.</p>
        <?php endif; ?>
    </div>

    <a href="adminDashboard.php" class="back-button">Return to Dashboard</a>

    <script>
        // Function to restore the project using AJAX
        function restoreProject(projectId) {
            $.ajax({
                type: "POST",
                url: "recently_deleted.php",  // Same file to handle AJAX
                data: {
                    restore_id: projectId
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Project Restored!', response.message, 'success').then(() => {
                            location.reload(); // Reload the page after showing the success message
                        });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'An error occurred while restoring the project.', 'error');
                }
            });
        }
    </script>

</body>
</html>

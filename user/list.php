<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$db = (new Database())->connect();
$project = new Project($db);

// Fetch all non-deleted projects
$projects = $project->read();
?>

<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$db = (new Database())->connect();
$project = new Project($db);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $progress = $_POST['progress'];

    // Attempt to update the project
    if ($project->update($id, $title, $progress)) {
        header('Location: update.php?id=' . $id . '&success=true');
        exit;
    } else {
        header('Location: update.php?id=' . $id . '&success=false');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: white;
        }

        .project-list {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .project-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .project-item:hover {
            background-color: #f0f0f0;
        }

        .project-title {
            font-size: 1.2rem;
            color: #333;
        }

        .project-progress {
            font-size: 1rem;
            color: #007bff;
        }

        .delete-btn,
        .update-btn {
            padding: 6px 12px;
            font-size: 0.9rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: #fff;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .update-btn {
            background-color: #f39c12;
            color: #fff;
            margin-right: 10px;
        }

        .update-btn:hover {
            background-color: #e67e22;
        }

        .no-projects {
            text-align: center;
            color: #777;
        }

        .return-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .return-btn:hover {
            background-color: #2980b9;
        }

        @media (max-width: 600px) {
            .project-list {
                width: 95%;
            }
        }
    </style>
</head>

<body>

    <h1>Project List</h1>

    <div class="project-list">
        <?php if ($projects && count($projects) > 0): ?>
            <ul>
                <?php foreach ($projects as $proj): ?>
                    <li class="project-item">
                        <div>
                            <div class="project-title"><?php echo htmlspecialchars($proj['title']); ?></div>
                            <div class="project-progress"><?php echo htmlspecialchars($proj['progress']); 
                            ?>%</div>
                        </div>
                        <div>
                            <a href="update.php?id=<?php echo $proj['id']; ?>" class="update-btn">Update</a>
                            <a href="delete.php?id=<?php echo $proj['id']; ?>" class="delete-btn" 
                            onclick="return confirmDelete(event)">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-projects">No active projects found.</p>
        <?php endif; ?>
    </div>

    <button class="return-btn" onclick="window.location.
    href='userDashboard.php'">Return to Dashboard</button>

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const deleteLink = event.target.getAttribute('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this project!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteLink;
                }
            });
        }
    </script>

</body>

</html>
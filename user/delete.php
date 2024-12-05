<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$message = "";
$success = false;

if (isset($_GET['id'])) {
    $db = (new Database())->connect();
    $project = new Project($db);

    // Perform delete operation
    if ($project->delete($_GET['id'])) {
        $message = "Project successfully deleted.";
        $success = true;
    } else {
        $message = "Error deleting project.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff7eb3, #ff758c, #ff00bf);
            background-size: 200% 200%;
            animation: gradient-animation 10s infinite ease-in-out;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .cta-button button {
            background-color: #ffffff;
            color: #ff00bf;
            padding: 10px 20px;
            font-size: 1rem;
            border: 2px solid #ff00bf;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cta-button button:hover {
            background-color: #ff00bf;
            color: white;
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($message): ?>
                Swal.fire({
                    title: '<?php echo $success ? "Success!" : "Error!"; ?>',
                    text: '<?php echo $message; ?>',
                    icon: '<?php echo $success ? "success" : "error"; ?>',
                    confirmButtonText: 'OK',
                    willClose: () => {
                        window.location.href = 'list.php';
                    }
                });
            <?php endif; ?>
        });
    </script>

    <div class="cta-button">
        <button onclick="window.location.href='adminDashboard.php'">Return</button>
    </div>
</body>

</html>
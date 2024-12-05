<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->connect();
    $project = new Project($db);

    $title = $_POST['title'];
    $description = $_POST['description'];

    // Create project with default progress (0%)
    if ($project->create($title, $description)) {
        echo "<p class='success-message'>Project Created Successfully!</p>";
    } else {
        echo "<p class='error-message'>Error Creating Project.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1d2b64, #f8cdda);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #5C6BC0;
        }

        .form-container {
            background: #FFFFFF;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        label {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #444;
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #F9F9F9;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            color: #333;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus {
            background-color: #E8F5E9;
            border-color: #5C6BC0;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #5C6BC0;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #3E4A89;
            transform: translateY(-2px);
        }

        .cta-button {
            margin-top: 20px;
        }

        .cta-button a {
            text-decoration: none;
        }

        .cta-button button {
            padding: 12px 20px;
            background-color: #B3E5FC;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cta-button button:hover {
            background-color: #81D4FA;
            transform: translateY(-2px);
        }


        .success-message {
            color: #388E3C;
            font-size: 1.1rem;
            margin-top: 20px;
            font-weight: 600;
        }

        .error-message {
            color: #D32F2F;
            font-size: 1.1rem;
            margin-top: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Create Project</h1>

        <form method="POST" action="">
            <label for="title">Project Title</label>
            <input type="text" id="title" name="title" required><br>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea><br>

            <button type="submit">Create Project</button>
        </form>

        <div class="cta-button">
            <a href="userDashboard.php">
                <button onclick="window.history.back()">Return</button>
            </a>
        </div>
    </div>

</body>

</html>
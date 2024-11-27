<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

// Initialize the database connection and project object
$db = (new Database())->connect();
$project = new Project($db);

// Fetch all projects from the database
$projects = $project->read();

// Prepare data for the graph
$chartData = [];
if ($projects && count($projects) > 0) {
    $seenProjects = [];
    foreach ($projects as $proj) {
        if (in_array($proj['id'], $seenProjects)) {
            continue;
        }
        $seenProjects[] = $proj['id'];
        $chartData[] = [
            'title' => htmlspecialchars($proj['title']),
            'progress' => (int)$proj['progress'],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creative Project List</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #fddb3a;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* Chart Section */
        .chart-container {
            margin-bottom: 30px;
        }

        canvas {
            display: block;
            margin: 0 auto;
        }

        /* Project List Styles */
        .project {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .project:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }

        .project p {
            margin: 8px 0;
            font-size: 1em;
        }

        .project a {
            text-decoration: none;
            color: #fddb3a;
            font-weight: bold;
            padding: 6px 12px;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 5px;
            margin-right: 10px;
            transition: background 0.3s, color 0.3s;
        }

        .project a:hover {
            background: #fddb3a;
            color: #1e3c72;
        }

        /* Button Styles */
        .cta-button {
            text-align: center;
        }

        .cta-button button {
            background: linear-gradient(90deg, #ff7f50, #ff6347);
            color: white;
            font-size: 1em;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .cta-button button:hover {
            background: linear-gradient(90deg, #ff4500, #e63946);
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Project List</h1>

        <!-- Chart Section -->
        <div class="chart-container">
            <canvas id="progressChart" height="250"></canvas>
        </div>

        <!-- Project List -->
        <?php if ($projects && count($projects) > 0): ?>
            <?php foreach ($projects as $proj): ?>
                <?php
                $title = htmlspecialchars($proj['title']);
                $progress = htmlspecialchars($proj['progress']);
                $status = htmlspecialchars($proj['status']);
                $id = htmlspecialchars($proj['id']);
                ?>
                <div class="project">
                    <p><strong>Title:</strong> <?= $title ?></p>
                    <p><strong>Progress:</strong> <?= $progress ?>%</p>
                    <p><strong>Status:</strong> <?= $status ?></p>
                    <a href="update.php?id=<?= $id ?>">Update</a>
                    <a href="delete.php?id=<?= $id ?>">Delete</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No projects found.</p>
        <?php endif; ?>

        <!-- Return Button -->
        <div class="cta-button">
            <button onclick="window.location.href='adminDashboard.php'">Return</button>
        </div>
    </div>

    <script>
        // Prepare data for the chart
        const chartData = <?= json_encode($chartData) ?>;

        // Extract labels and data
        const labels = chartData.map(item => item.title);
        const data = chartData.map(item => item.progress);

        // Initialize Chart.js
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Project Progress (%)',
                    data: data,
                    backgroundColor: [
                        '#ff4500', '#ff6347', '#ffa07a', '#ff7f50', '#ffd700',
                    ],
                    hoverBackgroundColor: [
                        '#e63946', '#d62828', '#f77f00', '#fcbf49', '#ffe066',
                    ],
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                        },
                    },
                },
            },
        });
    </script>
</body>
</html>

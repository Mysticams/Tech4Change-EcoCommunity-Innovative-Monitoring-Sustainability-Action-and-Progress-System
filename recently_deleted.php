<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

// Initialize the database connection and project object
$db = (new Database())->connect();
$project = new Project($db);

// Fetch recently deleted projects (within the last 30 days)
$recentlyDeletedProjects = $project->readRecentlyDeleted(30); // You can adjust the number of days

// Prepare data for the graph
$chartData = [];
if ($recentlyDeletedProjects && count($recentlyDeletedProjects) > 0) {
    foreach ($recentlyDeletedProjects as $proj) {
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
    <title>Recently Deleted Projects</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1d2b64, #f8cdda);
            color: #333;
        }

        /* Main container */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Header styles */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #007bff;
            margin: 10px auto 0;
        }

        /* Chart container */
        .chart-container {
            margin-bottom: 40px;
        }

        /* Project card styles */
        .project {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .project:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .project p {
            margin: 5px 0;
        }

        .project-actions {
            display: flex;
            gap: 15px;
        }

        .project a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(90deg, #28a745, #218838);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .project a:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Return button */
        .cta-button button {
            padding: 12px 20px;
            background: linear-gradient(135deg, #ff0099, #493240);
            color: #fff;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .cta-button button:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #e6008d, #3a2837);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recently Deleted Projects</h1>

        <!-- Chart Section -->
        <div class="chart-container">
            <canvas id="progressChart"></canvas>
        </div>

        <!-- Project List -->
        <?php if ($recentlyDeletedProjects && count($recentlyDeletedProjects) > 0): ?>
            <?php foreach ($recentlyDeletedProjects as $proj): ?>
                <?php
                $title = htmlspecialchars($proj['title']);
                $progress = htmlspecialchars($proj['progress']);
                $status = htmlspecialchars($proj['status']);
                $deletedAt = htmlspecialchars($proj['deleted_at']);
                $id = htmlspecialchars($proj['id']);
                ?>
                <div class="project">
                    <div>
                        <p><strong>Title:</strong> <?= $title ?></p>
                        <p><strong>Progress:</strong> <?= $progress ?>%</p>
                        <p><strong>Status:</strong> <?= $status ?></p>
                        <p><strong>Deleted At:</strong> <?= $deletedAt ?></p>
                    </div>
                    <div class="project-actions">
                        <a href="restore.php?id=<?= $id ?>">Restore</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No recently deleted projects found.</p>
        <?php endif; ?>

        <!-- Return Button -->
        <div class="cta-button" style="text-align: center;">
            <button onclick="window.location.href='adminDashboard.php'">Return</button>
        </div>
    </div>

    <script>
        // Prepare data for the chart
        const chartData = <?= json_encode($chartData) ?>;

        // Extract labels and data for the chart
        const labels = chartData.map(item => item.title);
        const data = chartData.map(item => item.progress);

        // Initialize Chart.js
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Project Progress (%)',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Progress (%)',
                        },
                    },
                },
            },
        });
    </script>
</body>
</html>

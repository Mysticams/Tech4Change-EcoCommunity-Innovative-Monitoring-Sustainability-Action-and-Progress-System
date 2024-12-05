<?php
require_once 'Database.php';
require_once 'CrudOperations.php';

$db = (new Database())->connect();
$project = new Project($db);

// Fetch the progress report data
$reportData = $project->generateProgressReport();

$titles = $reportData['titles'];
$progress = $reportData['progress'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <!-- Include Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
        }

        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .return-btn {
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #ff6347;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .return-btn:hover {
            background-color: #ff4500;
        }
    </style>
</head>

<body>

    <h1>Project Progress Report</h1>

    <!-- Chart.js container -->
    <div class="chart-container">
        <canvas id="progressChart"></canvas>
    </div>

    <script>
        // Data for the chart
        const titles = <?php echo json_encode($titles); ?>;
        const progress = <?php echo json_encode($progress); ?>;

        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: titles,
                datasets: [{
                    label: 'Project Progress (%)',
                    data: progress,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100 // Limit  100 for percentage
                    }
                }
            }
        });
    </script>

    <a href="projects.php" class="return-btn">Return to Projects</a>

</body>

</html>
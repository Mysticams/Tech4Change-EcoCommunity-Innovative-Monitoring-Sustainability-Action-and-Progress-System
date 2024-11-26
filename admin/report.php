<?php
require_once 'Database.php';
require_once 'crudOperations.php';

// Establish database connection
$database = new Database();
$db = $database->getConnection();

// Create Project object
$project = new Project($db);

// Generate the progress report data
$reportData = $project->generateProgressReport();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Progress Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        #chart-container {
            width: 80%;
            margin: 0 auto;
        }
        .cta-button {
    margin-top: 20px;
    display: flex;
    justify-content: center; /* Centers the button horizontally */
}

.cta-button button {
    background-color: #FF00BF;
    color: white;
    padding: 10px 15px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>

    <h2>Project Progress Analytics</h2>

    <div id="chart-container">
        <canvas id="progressChart"></canvas>
    </div>

    <div class="cta-button">
    <a href="adminDashboard.php">
        <button onclick="window.history.back()">Return</button>
    </a>
</div>

    <script>
        // Data passed from PHP to JavaScript
        const projectTitles = <?php echo json_encode($reportData['titles']); ?>;
        const projectProgress = <?php echo json_encode($reportData['progress']); ?>;

        // Chart.js setup
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'bar', // or 'line', 'pie', etc.
            data: {
                labels: projectTitles, // Project titles on x-axis
                datasets: [{
                    label: 'Project Progress (%)',
                    data: projectProgress, // The progress values
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true, // Start the y-axis from 0
                        max: 100 // Max value for progress (100%)
                    }
                }
            }
        });
    </script>

    <form method="POST" action="export.php">
        <button type="submit" name="export_csv">Export Report as CSV</button>
    </form>

</body>
</html>

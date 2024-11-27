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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4a90e2, #50e3c2); /* Changed background gradient */
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h2 {
            font-size: 2.8rem;
            text-align: center;
            margin-top: 40px;
            color: #ffffff;
            text-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            transition: transform 0.3s ease-in-out;
        }

        h2:hover {
            transform: scale(1.1) rotate(2deg);
        }

        #chart-container {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1.5s ease-in-out;
        }

        canvas {
            max-height: 500px;
            border-radius: 15px;
        }

        .cta-button {
            margin-top: 40px;
        }

        .cta-button button {
            background: linear-gradient(90deg, #FF00BF, #800080);
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-transform: uppercase;
        }

        .cta-button button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #ff6347, #e63946);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
        }

        form {
            margin-top: 25px;
        }

        form button {
            width: 100%;
            max-width: 250px;
            padding: 15px;
            font-size: 1rem;
            background-color: #8e44ad;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #9b59b6;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <h2>Project Progress Analytics</h2>

    <div id="chart-container">
        <canvas id="progressChart"></canvas>
    </div>

    <!-- Return Button -->
    <div class="cta-button">
        <a href="adminDashboard.php">
            <button>Return</button>
        </a>
    </div>

    <!-- Export Button -->
    <form method="POST" action="export.php">
        <button type="submit" name="export_csv">Export Report as CSV</button>
    </form>

    <script>
        // Data passed from PHP to JavaScript
        const projectTitles = <?php echo json_encode($reportData['titles']); ?>;
        const projectProgress = <?php echo json_encode($reportData['progress']); ?>;

        // Chart.js setup
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'doughnut', // Enhanced visualization with doughnut chart
            data: {
                labels: projectTitles, // Project titles on x-axis
                datasets: [{
                    label: 'Project Progress (%)',
                    data: projectProgress, // The progress values
                    backgroundColor: [
                        '#ff4500', '#ff6347', '#ffa07a', '#ff7f50', '#ffd700',
                        '#00bcd4', '#4caf50', '#8e44ad', '#3498db', '#f39c12',
                    ],
                    borderColor: 'rgba(255, 255, 255, 0.8)',
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            font: {
                                size: 14,
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            color: '#fff',
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',
                        },
                    },
                    x: {
                        ticks: {
                            color: '#fff',
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',
                        },
                    },
                },
            },
        });
    </script>

</body>
</html>

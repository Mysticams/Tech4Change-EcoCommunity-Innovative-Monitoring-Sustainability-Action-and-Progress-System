<?php

$analytics_file = 'analytics.json';

if (file_exists($analytics_file)) {
    $analytics_data = json_decode(file_get_contents($analytics_file), true);
} else {
    $analytics_data = [];
}

// Prepare data for the chart
$timestamps = [];
$scores = [];

foreach ($analytics_data as $action) {
    $timestamps[] = date('Y-m-d H:i:s', $action['timestamp']);
    $scores[] = $action['score'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            text-align: center;
            padding: 50px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #388e3c;
        }

        .chart-container {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Game Analytics</h1>

        <div class="chart-container">
            <canvas id="scoreChart"></canvas>
        </div>

        <div class="hero1">
            <a href="header.php" class="cta-button" button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
        </div>
    </div>


    <script>
        const ctx = document.getElementById('scoreChart').getContext('2d');
        const scoreChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($timestamps); ?>,
                datasets: [{
                    label: 'Score Over Time',
                    data: <?php echo json_encode($scores); ?>,
                    borderColor: 'rgb(76, 175, 80)',
                    fill: false,
                    tension: 0.1,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 0,
                            autoSkip: true
                        },
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Score'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>
<?php
require 'Database.php';
require 'Mood.php';

$database = new Database();
$db = $database->connect();
$mood = new Mood($db);

// Fetch data
$moodStats = $mood->getMoodStats();
$treeCount = $mood->getTreeCount();

// Calculate the total count
$totalCount = 0;
foreach ($moodStats as $stat) {
    $totalCount += $stat['count'];
}

// Prepare data for Chart.js
$labels = [];
$data = [];
$colors = ['#FF00BF', '#FF7F00', '#FFD700', '#00FFBF', '#0080FF'];

foreach ($moodStats as $index => $stat) {
    $labels[] = $stat['mood'];
    $data[] = $stat['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Analytics - Pie Chart</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1d3557, #457b9d, #a8dadc);
            color: #f1faee;
            text-align: center;
        }

        h1, h2 {
            margin: 20px 0;
        }

        h1 {
            font-size: 2.5em;
            font-weight: 700;
            color: #f1faee;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-size: 1.1em;
            font-weight: 400;
        }

        .chart-container {
            position: relative;
            width: 80%;  /* Reduced size */
            max-width: 300px;  /* Further reduce the size */
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 10px 15px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 10px;
            transition: transform 0.2s, background 0.3s;
        }

        .legend-item:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.2);
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .cta-button {
            margin-top: 30px;
        }

        .cta-button button {
            background: linear-gradient(90deg, #ff0099, #ff7f00);
            color: #fff;
            padding: 12px 20px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }

        .cta-button button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #d40082, #d46e00);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Mood Analytics</h1>
<div class="chart-container">
    <canvas id="moodChart"></canvas>
</div>

<div class="legend">
    <?php foreach ($labels as $index => $label): ?>
        <div class="legend-item">
            <div class="legend-color" style="background-color: <?= $colors[$index % count($colors)]; ?>"></div>
            <span><?= $label ?> (<?= round(($data[$index] / $totalCount) * 100, 1) ?>%)</span>
        </div>
    <?php endforeach; ?>
</div>

<h2>Total Trees Planted: <span style="color: #ffd700; font-size: 1.8em;">🌳 <?= $treeCount ?> 🌳</span></h2>

<div class="cta-button">
    <a href="projects.php">
        <button onclick="window.history.back()">Return</button>
    </a>
</div>

<script>
    const ctx = document.getElementById('moodChart').getContext('2d');
    const moodChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                data: <?= json_encode($data) ?>,
                backgroundColor: <?= json_encode($colors) ?>,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // Custom legend is used
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const percentage = ((value / <?= $totalCount ?>) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>

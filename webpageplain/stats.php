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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        h1, h2 {
            color: #333;
        }

        .chart-container {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 20px auto;
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
            margin: 5px 10px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .cta-button {
            margin-top: 20px;
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Mood Analytics - Pie Chart</h1>
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

<h2>Total Trees Planted: <?= $treeCount ?> 🌳</h2>

<div class="cta-button">
    <a href="adminDashboard.php">
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
                backgroundColor: <?= json_encode($colors) ?>
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // We are using custom legend
                }
            }
        }
    });
</script>

</body>
</html>

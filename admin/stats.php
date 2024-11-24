<?php
require 'Database.php';
require 'Mood.php';

$database = new Database();
$db = $database->connect();
$mood = new Mood($db);

<<<<<<< HEAD
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
=======
$moodStats = $mood->getMoodStats();
$treeCount = $mood->getTreeCount();

// Calculate total count for percentages
$totalCount = array_sum(array_column($moodStats, 'count'));
>>>>>>> fee35ec (added mood tracker and updated files)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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

=======
    <title>Mood Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .pie-chart {
            width: 400px; /* Increased size */
            height: 400px; /* Increased size */
            border-radius: 50%;
            background: conic-gradient(
                <?php 
                $currentPercentage = 0;
                foreach ($moodStats as $index => $stat) {
                    $percentage = ($stat['count'] / $totalCount) * 100;
                    $color = match($index % 6) {
                        0 => '#FF6384', // Red
                        1 => '#36A2EB', // Blue
                        2 => '#FFCE56', // Yellow
                        3 => '#4BC0C0', // Teal
                        4 => '#9966FF', // Purple
                        5 => '#FF9F40', // Orange
                    };
                    echo "$color $currentPercentage%, $color " . ($currentPercentage + $percentage) . "%, ";
                    $currentPercentage += $percentage;
                }
                ?> 
                white 0%
            );
            margin: 20px auto;
        }
        .legend {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
>>>>>>> fee35ec (added mood tracker and updated files)
        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
<<<<<<< HEAD
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
=======
        }
    </style>
</head>
<body>

<h1>Mood Statistics</h1>
<div class="pie-chart"></div>

<div class="legend">
    <?php 
    $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
    foreach ($moodStats as $index => $stat) {
        echo '<div class="legend-item">';
        echo '<div class="legend-color" style="background-color: ' . $colors[$index % count($colors)] . ';"></div>';
        echo '<span>' . $stat['mood'] . ': ' . $stat['count'] . '</span>';
        echo '</div>';
    }
    ?>
</div>

<h2>Total Trees Planted: <?php echo $treeCount; ?> 🌳</h2>

<a href="index.php" class="cta-button">
    <button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button>
</a>
>>>>>>> fee35ec (added mood tracker and updated files)

</body>
</html>

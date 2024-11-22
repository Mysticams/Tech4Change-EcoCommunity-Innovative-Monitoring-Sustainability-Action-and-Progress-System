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

// Calculate percentages and cumulative angles
$angles = [];
$cumulativeAngle = 0;

foreach ($moodStats as $stat) {
    $percentage = ($stat['count'] / $totalCount) * 100;
    $angle = ($percentage / 100) * 360; // Convert to degrees
    $angles[] = [
        'mood' => $stat['mood'],
        'count' => $stat['count'],
        'percentage' => $percentage,
        'startAngle' => $cumulativeAngle,
        'endAngle' => $cumulativeAngle + $angle,
    ];
    $cumulativeAngle += $angle;
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

        .pie-chart {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 20px auto;
            border-radius: 50%;
            background: conic-gradient(
                <?php
                $colors = ['#FF00BF', '#FF7F00', '#FFD700', '#00FFBF', '#0080FF'];
                foreach ($angles as $index => $angle) {
                    $color = $colors[$index % count($colors)];
                    echo "$color {$angle['startAngle']}deg, $color {$angle['endAngle']}deg, ";
                }
                ?>
                #f9f9f9 360deg
            );
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
</head>
<body>

<h1>Mood Analytics - Pie Chart</h1>
<div class="pie-chart"></div>

<div class="legend">
    <?php foreach ($angles as $index => $angle): ?>
        <div class="legend-item">
            <div class="legend-color" style="background-color: <?= $colors[$index % count($colors)]; ?>"></div>
            <span><?= $angle['mood'] ?> (<?= round($angle['percentage'], 1) ?>%)</span>
        </div>
    <?php endforeach; ?>
</div>

<h2>Total Trees Planted: <?= $treeCount ?> 🌳</h2>

<div class="cta-button">
    <a href="header.php">
        <button onclick="window.history.back()">Return</button>
    </a>
</div>

</body>
</html>

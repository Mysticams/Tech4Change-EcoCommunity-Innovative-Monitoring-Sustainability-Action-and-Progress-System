<?php
require 'Database.php';
require 'Mood.php';

$database = new Database();
$db = $database->connect();
$mood = new Mood($db);

$moodStats = $mood->getMoodStats();
$treeCount = $mood->getTreeCount();

// Calculate total count for percentages
$totalCount = array_sum(array_column($moodStats, 'count'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
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

</body>
</html>

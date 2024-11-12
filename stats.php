<?php
require 'Database.php';
require 'Mood.php';

$database = new Database();
$db = $database->connect();
$mood = new Mood($db);

$moodStats = $mood->getMoodStats();
$treeCount = $mood->getTreeCount();

echo "<h1>Mood Statistics</h1>";
foreach ($moodStats as $stat) {
    echo $stat['mood'] . ": " . $stat['count'] . "<br>";
}

echo "<h2>Total Trees Planted: $treeCount 🌳</h2>";
?>

<body>

    <a href="index.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>
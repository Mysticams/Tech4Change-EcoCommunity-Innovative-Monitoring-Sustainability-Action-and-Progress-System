<?php
require 'Database.php';
require 'Mood.php';

$database = new Database();
$db = $database->connect();
$mood = new Mood($db);

// mood and plant tree are set in POST request
$mood->user_id = 1;
$mood->mood = isset($_POST['mood']) ? $_POST['mood'] : null;
$mood->plant_tree = isset($_POST['plant_tree']) ? 1 : 0;


$message = '';

if ($mood->mood) {
    if ($mood->saveMood()) {

        // Check if user plant a tree
        if ($mood->plant_tree) {
            $message = "<h2>Thank you! You've contributed to planting a tree 🌳!</h2>";
        } else {
            $message = "<h2>Thank you for sharing your mood 😊!</h2>";
        }
    } else {
        $message = "<h2>There was an error saving your mood. Please try again.</h2>";
    }
}

// Fetch mood statistics and total trees planted
$moodStats = $mood->getMoodStats();
$treeCount = $mood->getTreeCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mood Tracker Submission</title>
</head>

<body>

    <!-- Display the submission message -->
    <?php echo $message; ?>

    <!-- Display the total trees planted -->
    <h2>Total Trees Planted So Far: <?php echo $treeCount ?? 0; ?> 🌳</h2>

    <a href="action.php" class="cta-button"><button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
</body>

</html>
<?php
session_start();

//  game state if it doesn't exist
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['item_count'] = 0;
}


$items = [
    'plastic bottle' => 'recycle',
    'banana peel' => 'compost',
    'paper' => 'recycle',
    'apple core' => 'compost',
    'can' => 'recycle',
    'plastic fork' => 'trash',
    'orange peel' => 'compost',
    'aluminum foil' => 'recycle',
    'broken glass' => 'trash'
];

// random item to sort
$item_keys = array_keys($items);
$item_to_sort = $item_keys[array_rand($item_keys)];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_bin = $_POST['bin'];
    $correct_bin = $items[$item_to_sort];

    // player's action
    logAction($item_to_sort, $selected_bin, $correct_bin);

    // correct/ incorrect
    if ($selected_bin == $correct_bin) {
        $_SESSION['score'] += 10;
    } else {
        $_SESSION['score'] -= 5;
    }

    $_SESSION['item_count']++;

    if ($_SESSION['item_count'] >= 10) {
        header("Location: gameOver.php");
        exit();
    }
}

//  score updates 
function logAction($item, $selected_bin, $correct_bin)
{
    $analytics_file = 'analytics.json';
    $action = [
        'timestamp' => time(),
        'item' => $item,
        'selected_bin' => $selected_bin,
        'correct_bin' => $correct_bin,
        'score' => $_SESSION['score']
    ];

    // Check file exists, if not create
    if (file_exists($analytics_file)) {
        $analytics_data = json_decode(file_get_contents($analytics_file), true);
    } else {
        $analytics_data = [];
    }

    $analytics_data[] = $action;

    // Save the updated data 
    file_put_contents($analytics_file, json_encode($analytics_data));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            background-image: url('img/game.avif');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            color: #2e7d32;
        }

        .item {
            font-size: 24px;
            color: #d32f2f;
            margin-bottom: 20px;
        }

        .bins {
            margin: 20px 0;
        }

        .bin {
            padding: 20px;
            margin: 10px;
            background-color: #4caf50;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .bin:hover {
            background-color: #388e3c;
        }

        .score {
            margin-top: 20px;
            font-size: 20px;
            color: #0288d1;
        }

        button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .hero1 a {
            background-color: #FF00BF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }

        .hero1 a:hover {
            background-color: #D400A8;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Environmental Sorting Game</h1>

        <div class="item">
            <p>Sort this item: <strong><?php echo ucfirst($item_to_sort); ?></strong></p>
        </div>

        <div class="bins">
            <form method="POST">
                <button type="submit" name="bin" value="recycle" class="bin">Recycle</button>
                <button type="submit" name="bin" value="compost" class="bin">Compost</button>
                <button type="submit" name="bin" value="trash" class="bin">Trash</button>
            </form>
        </div>

        <div class="score">
            <p>Score: <?php echo $_SESSION['score']; ?></p>
        </div>

        <div class="hero1">
            <a href="header.php" class="cta-button" onclick="window.history.back()">Return</a>
        </div>
    </div>

</body>

</html>
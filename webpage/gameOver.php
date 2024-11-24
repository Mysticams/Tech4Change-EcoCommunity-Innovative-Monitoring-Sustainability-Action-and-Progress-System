<?php
session_start();

// End game if the session is still active
if (isset($_SESSION['score'])) {
    $final_score = $_SESSION['score'];
    session_destroy(); // Destroy session at the end of the game
} else {
    $final_score = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #d32f2f;
        }

        .score {
            font-size: 30px;
            color: #388e3c;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>

    <h1>Game Over</h1>
    <div class="score">
        <p>Your final score is: <?php echo $final_score; ?></p>
    </div>
    <form action="game.php" method="GET">
        <button type="submit">Restart Game</button>
    </form>

    <form action="gameAnalytics.php" method="GET">
        <button type="submit">Game Analytics</button>
    </form>

    <div class="hero1">
            <a href="home.php" class="cta-button" button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button></a>
        </div>
</body>
</html>

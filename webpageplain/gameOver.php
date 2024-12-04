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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 50vh;
            margin: 0;
        }

        h1 {
            color: #d32f2f;
        }

        .score {
            font-size: 30px;
            color: #388e3c;
            margin: 20px;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            width: 200px;
        }

        .button:hover {
            background-color: #388e3c;
        }

        .button.return {
            background-color: #FF00BF;
        }

        .button.return:hover {
            background-color: #D400A8;
        }

        form {
            display: inline-block;
        }

    </style>
</head>

<body>

    <h1>Game Over</h1>
    <div class="score">
        <p>Your final score is: <?php echo $final_score; ?></p>
    </div>

    <div class="button-container">
        <!-- Restart Game Button -->
        <form action="game.php" method="GET" style="display: inline;">
            <button type="submit" class="button">Restart Game</button>
        </form>

        <!-- Game Analytics Button -->
        <form action="gameAnalytics.php" method="GET" style="display: inline;">
            <button type="submit" class="button">Game Analytics</button>
        </form>

        <!-- Return to Home Button -->
        <a href="home.php" class="button return">Return</a>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mood Tracker</title>
</head>

<body>
    <h1>Track Your Mood</h1>
    <form action="submit.php" method="POST">
        <label for="mood">How are you feeling today?</label><br>
        <select name="mood" id="mood" required>
            <option value="">Select Mood</option>
            <option value="Happy">Happy 😊</option>
            <option value="Sad">Sad 😢</option>
            <option value="Anxious">Anxious 😟</option>
            <option value="Excited">Excited 🎉</option>
        </select><br><br>

        <label>
            <input type="checkbox" name="plant_tree" value="yes"> Help plant a tree 🌳
        </label><br><br>

        <input type="submit" value="Submit Mood">
    </form>
</body>

</html>
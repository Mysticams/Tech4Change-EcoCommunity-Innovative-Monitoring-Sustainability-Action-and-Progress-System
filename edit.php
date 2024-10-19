<?php
// edit.php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "eco_community"; 

$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action_name = $_POST['action_name'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];

    $sql = "UPDATE sustainability_actions SET action_name='$action_name', description='$description', progress='$progress' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM sustainability_actions WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Action</title>
</head>
<body>
    <h1>Edit Action</h1>
    <form method="POST">
        <label for="action_name">Action Name:</label><br>
        <input type="text" id="action_name" name="action_name" value="<?= $row['action_name'] ?>" required><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?= $row['description'] ?></textarea><br>
        <label for="progress">Progress (%):</label><br>
        <input type="number" id="progress" name="progress" value="<?= $row['progress'] ?>" min="0" max="100" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
$conn->close();
?>

<a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
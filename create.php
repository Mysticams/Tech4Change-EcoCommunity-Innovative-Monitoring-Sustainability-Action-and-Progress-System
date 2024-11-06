<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $action_description = $_POST['action_description'];
    $progress_status = $_POST['progress_status'];

    $sql = "INSERT INTO eco_community (name, email, action_description, progress_status) VALUES ('$name', '$email', '$action_description', '$progress_status')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Record</title>
</head>

<body>
    <h2>Create New Action</h2>
    <form method="post" action="">
        Name: <input type="text" name="name"><br><br>
        Email: <input type="text" name="email"><br><br>
        Action Description: <textarea name="action_description"></textarea><br><br>
        Progress Status: <input type="text" name="progress_status"><br><br>
        <input type="submit" value="Create">
    </form>
</body>

</html>

<a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
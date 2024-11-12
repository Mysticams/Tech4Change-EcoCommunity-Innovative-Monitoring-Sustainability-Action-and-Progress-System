<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM eco_community WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $action_description = $_POST['action_description'];
    $progress_status = $_POST['progress_status'];

    $sql = "UPDATE eco_community SET name='$name', email='$email', action_description='$action_description', progress_status='$progress_status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Record</title>
</head>

<body>
    <h2>Update Action</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        Action Description: <textarea name="action_description"><?php echo $row['action_description']; ?></textarea><br><br>
        Progress Status: <input type="text" name="progress_status" value="<?php echo $row['progress_status']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>

    <a href="index.php">Return to Home</a> <!-- Add a link to the home page -->
</body>

</html>
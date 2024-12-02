<?php

$conn = mysqli_connect("localhost", "root", "", "finalproj");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch user details
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

// Update user details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $updateSql = "UPDATE user SET username = '$username', email = '$email', role = '$role' WHERE id = $id";
    if ($conn->query($updateSql) === TRUE) {
        echo "User updated successfully.";
        header("Location: userlist.php"); 
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            
            <!--User add form-->
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="Admin" <?php echo $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="User" <?php echo $user['role'] == 'User' ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>

  <style>

body {
    font-family: Arial, sans-serif;
    background-color: #F6F5FF;
    margin: 0;
    padding: 0;
}

.container {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px;
    padding: 0;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    color: #555555;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input:focus,
select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

  </style>
  
    
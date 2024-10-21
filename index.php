<?php
session_start(); // Start a session

// Dummy user data (for demonstration purposes)
$users = [
    'test' => 'password',
    'admin' => 'adminpass'
];

// Variable to hold the error message
$errorMsg = '';

// Handle form submission for login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Check if the username exists and the password matches
    if (isset($users[$username]) && $users[$username] === $password) {
        // Successful login
        $_SESSION['username'] = $username; // Store username in session
        $_SESSION['role'] = $role; // Store role in session if needed
        header("Location: dashboard.php"); // Redirect to a dashboard or another page
        exit();
    } else {
        // Invalid credentials
        $errorMsg = 'Invalid credentials';
    }
}

// Handle form submission for sign up
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signupUsername']) && isset($_POST['signupPassword'])) {
    $signupUsername = $_POST['signupUsername'] ?? '';
    $signupPassword = $_POST['signupPassword'] ?? '';
    $signupEmail = $_POST['signupEmail'] ?? '';
    $signupRole = $_POST['signupRole'] ?? '';

    // Simple validation: Check if username already exists
    if (array_key_exists($signupUsername, $users)) {
        $errorMsg = 'Username already exists. Please choose a different one.';
    } else {
        // Register the user
        $users[$signupUsername] = $signupPassword; // Store password (in a real app, hash it)
        
        // Set session variables
        $_SESSION['username'] = $signupUsername; // Store username in session
        $_SESSION['role'] = $signupRole; // Store role in session if needed

        // Redirect to the dashboard
        header("Location: dashboard.php"); // Redirect to the dashboard
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container" id="formContainer">
        <div id="loginFormContainer">
            <h2>Login</h2>
            <?php if ($errorMsg): ?>
                <p class="error" style="color: red; text-align: center;"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit">Login</button>
            </form>
            <div class="toggle-link" id="toSignUp">Don't have an account? Sign Up</div>
        </div>
        <div id="signUpFormContainer" style="display: none;">
            <h2>Sign Up</h2>
            <?php if ($errorMsg): ?>
                <p class="error" style="color: red; text-align: center;"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <input type="text" name="signupUsername" placeholder="Username" required>
                <input type="password" name="signupPassword" placeholder="Password" required>
                <input type="email" name="signupEmail" placeholder="Email" required>
                <select name="signupRole" id="signupRole" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit">Register</button>
            </form>
            <div class="toggle-link" id="toLogin">Already have an account? Login</div>
        </div>
    </div>

    <script>
        // JavaScript to toggle forms
        document.getElementById('toSignUp').onclick = function() {
            document.getElementById('loginFormContainer').style.display = 'none';
            document.getElementById('signUpFormContainer').style.display = 'block';
        };
        document.getElementById('toLogin').onclick = function() {
            document.getElementById('signUpFormContainer').style.display = 'none';
            document.getElementById('loginFormContainer').style.display = 'block';
        };
    </script>
</body>
</html>

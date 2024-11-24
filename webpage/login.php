<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container" id="formContainer">
        <div id="loginFormContainer">
            <h2>Login</h2>
            <?php if (!empty($errorMsg)): ?>
                <p class="error" style="color: red; text-align: center;"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>
            <form id="loginForm" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="button" id="loginButton" style="padding: 10px 20px; background-color: #AFE1AF; color: #006400; border: none; border-radius: 5px; font-size: 1em;">Login</button>
            </form>
            <div class="toggle-link" id="toRegister">Don't have an account? Register</div>
        </div>
        <div id="signUpFormContainer" style="display: none;">
            <h2>Register</h2>
            <?php if (!empty($errorMsg)): ?>
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
                <input type="submit" name="REGISTER" value="Register" />
            </form>
            <div class="toggle-link" id="toLogin">Already have an account? Login</div>
        </div>
    </div>

    <script>
        document.getElementById('toRegister').onclick = function() {
            document.getElementById('loginFormContainer').style.display = 'none';
            document.getElementById('signUpFormContainer').style.display = 'block';
        };
        document.getElementById('toLogin').onclick = function() {
            document.getElementById('signUpFormContainer').style.display = 'none';
            document.getElementById('loginFormContainer').style.display = 'block';
        };

        document.getElementById('loginButton').onclick = function() {
            var role = document.getElementById('role').value;
            var form = document.getElementById('loginForm');

            if (role === 'admin') {
                form.action = 'adminDashboard.php';
            } else if (role === 'user') {
                form.action = 'userDashboard.php';
            } else {
                alert('Invalid role selected.');
                return;
            }
            
            form.submit();
        };
    </script>
</body>

</html>

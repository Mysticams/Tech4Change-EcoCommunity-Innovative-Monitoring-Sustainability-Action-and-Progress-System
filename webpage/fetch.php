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
            <p id="loginError" style="color: red; text-align: center;"></p>
            <form id="loginForm">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit" style="padding: 10px 20px; background-color: #AFE1AF; color: #006400; border: none; border-radius: 5px; font-size: 1em;">Login</button>
            </form>
            <div class="toggle-link" id="toRegister">Don't have an account? Register</div>
        </div>
        <div id="signUpFormContainer" style="display: none;">
            <h2>Register</h2>
            <p id="registerError" style="color: red; text-align: center;"></p>
            <form id="registerForm">
                <input type="text" name="signupUsername" placeholder="Username" required>
                <input type="password" name="signupPassword" placeholder="Password" required>
                <input type="email" name="signupEmail" placeholder="Email" required>
                <select name="signupRole" required>
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
        // Toggle between forms
        document.getElementById('toRegister').onclick = function () {
            document.getElementById('loginFormContainer').style.display = 'none';
            document.getElementById('signUpFormContainer').style.display = 'block';
        };
        document.getElementById('toLogin').onclick = function () {
            document.getElementById('signUpFormContainer').style.display = 'none';
            document.getElementById('loginFormContainer').style.display = 'block';
        };

        // Handle Login
        document.getElementById('loginForm').onsubmit = async function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'LOGIN');

            const response = await fetch('index.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') {
                window.location.href = result.redirect;
            } else {
                document.getElementById('loginError').innerText = result.message;
            }
        };

        // Handle Registration
        document.getElementById('registerForm').onsubmit = async function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'REGISTER');

            const response = await fetch('index.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') {
                document.getElementById('registerError').style.color = 'green';
                document.getElementById('registerError').innerText = result.message;
            } else {
                document.getElementById('registerError').innerText = result.message;
            }
        };
    </script>
</body>

</html>

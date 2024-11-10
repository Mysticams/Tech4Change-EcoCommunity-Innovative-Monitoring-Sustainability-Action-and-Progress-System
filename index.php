<?php
session_start();

class User {
    protected $username;
    protected $password;
    protected $role;
    protected $users = [
        'test' => 'password',
        'admin' => 'adminpass'
    ];

    public function __construct($username, $password, $role) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    protected function userExists($username) {
        return isset($this->users[$username]);
    }
}

class LoginUser extends User {
    public function authenticate() {
        if ($this->userExists($this->username) && $this->users[$this->username] === $this->password) {
            $_SESSION['username'] = $this->username;
            $_SESSION['role'] = $this->role;
            header("Location: dashboard.php");
            exit();
        } else {
            return 'Invalid credentials';
        }
    }
}

class SignupUser extends User {
    private $email;

    public function __construct($username, $password, $role, $email) {
        parent::__construct($username, $password, $role);
        $this->email = $email;
    }

    public function register() {
        if ($this->userExists($this->username)) {
            return 'Username already exists. Please choose a different one.';
        } else {
            $this->users[$this->username] = $this->password;
            $_SESSION['username'] = $this->username;
            $_SESSION['role'] = $this->role;
            header("Location: dashboard.php");
            exit();
        }
    }
}

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $loginUser = new LoginUser($_POST['username'], $_POST['password'], $_POST['role']);
        $errorMsg = $loginUser->authenticate();
    } elseif (isset($_POST['signupUsername']) && isset($_POST['signupPassword'])) {
        $signupUser = new SignupUser($_POST['signupUsername'], $_POST['signupPassword'], $_POST['signupRole'], $_POST['signupEmail']);
        $errorMsg = $signupUser->register();
    }
}
?>

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
            <div class="toggle-link" id="toRegister">Don't have an account? Register</div>
        </div>
        <div id="signUpFormContainer" style="display: none;">
            <h2>Register</h2>
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
        document.getElementById('toRegister').onclick = function() {
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

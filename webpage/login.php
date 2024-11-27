<?php
session_start();

include "./Database.php";

// Initialize $errorMsg to avoid warnings
$errorMsg = '';

class User
{
    protected $username;
    protected $password;
    protected $email;
    protected $role;
    protected $user = [];
    protected $pdo = null;

    public function __construct($username, $password, $role = "", $email = "")
    {
        $db = new Database();
        $con = $db->connect();
        $this->pdo = $con;

        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;

        $stmt = $con->prepare("SELECT * FROM user WHERE `username`=? AND `password`=? LIMIT 1");
        $stmt->execute([$username, $password]);
        $this->user = $stmt->fetch();
    }

    protected function userExists($username)
    {
        return isset($this->user["username"]);
    }

    public function LoginUser()
    {
        if (empty($this->user) || $this->user["role"] !== $this->role) {
            return 'Invalid credentials or role mismatch';
        }

        $_SESSION['username'] = $this->username;
        $_SESSION["user_data"] = $this->user;
        $_SESSION['role'] = $this->role;

        // Redirect based on role
        if ($this->role === 'admin') {
            header("Location: adminDashboard.php");
        } else {
            header("Location: userDashboard.php");
        }
        exit();
    }

    public function RegisterUser()
    {
        if (!empty($this->user)) {
            return "User already exists";
        }

        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("INSERT INTO `user`(`username`, `password`, `email`, `role`) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $this->username,
                $this->password,
                $this->email,
                $this->role
            ]);
            $this->pdo->commit();

            return "Register Success";
        } catch (Exception $th) {
            $this->pdo->rollBack();
            return $th->getMessage();
        }

        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["LOGIN"])) {
        $loginUser = new User($_POST['username'], $_POST['password'], $_POST['role']);
        $errorMsg = $loginUser->LoginUser();
    }
    if (isset($_POST['REGISTER'])) {
        $signupUser = new User($_POST['signupUsername'], $_POST['signupPassword'], $_POST['signupRole'], $_POST['signupEmail']);
        $errorMsg = $signupUser->RegisterUser();
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
            <form action="login.php" method="POST">
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
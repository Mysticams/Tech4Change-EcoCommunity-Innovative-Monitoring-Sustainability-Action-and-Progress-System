<?php
session_start();
require 'database.php';

class User {
    protected $username;
    protected $password;
    protected $role;

    public function __construct($username, $password, $role) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}

class LoginUser extends User {
    public function authenticate() {
        global $mysqli;
        $query = "SELECT * FROM users WHERE username = ? AND role = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $this->username, $this->role);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($this->password, $user['password'])) {
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
        global $mysqli;
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            return 'Username already exists. Please choose a different one.';
        } else {
            $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ssss", $this->username, $passwordHash, $this->email, $this->role);
            $stmt->execute();

            $_SESSION['username'] = $this->username;
            $_SESSION['role'] = $this->role;
            header("Location: dashboard.php");
            exit();
        }
    }
}
?>

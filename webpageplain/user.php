<?php
session_start();
require 'Database.php';

class User
{
    protected $username;
    protected $password;
    protected $role;

    public function __construct($username, $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}

class LoginUser extends User
{
    public function authenticate()
    {
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

class SignupUser extends User
{
    private $email;

    public function __construct($username, $password, $role, $email)
    {
        parent::__construct($username, $password, $role);
        $this->email = $email;
    }

    public function register()
    {
        global $mysqli;

        // f username already exists
        $query = "SELECT COUNT(*) AS user_count FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $mysqli->error);
        }
        $stmt->bind_param("s", $this->username);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $row = $result->fetch_assoc()) {
            $count = $row['user_count'];
        } else {
            throw new Exception("Failed to fetch user count.");
        }
        $stmt->close();

        // If the username exists, return an error
        if ($count > 0) {
            return 'Username already exists. Please choose a different one.';
        }

        // Hash the password and insert the new user
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $mysqli->error);
        }
        $stmt->bind_param("ssss", $this->username, $passwordHash, $this->email, $this->role);
        $stmt->execute();
        $stmt->close();

        // Set session variables and redirect
        $_SESSION['username'] = $this->username;
        $_SESSION['role'] = $this->role;
        header("Location: dashboard.php");
        exit();
    }
}

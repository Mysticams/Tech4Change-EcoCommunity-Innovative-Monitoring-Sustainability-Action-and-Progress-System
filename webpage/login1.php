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
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
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

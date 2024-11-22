<?php
// Database connection
$host = 'localhost';
$dbname = 'chat_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = 'admin';
    $recipient = 'user';
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO chat_messages (sender, recipient, message) VALUES (:sender, :recipient, :message)");
        $stmt->execute([
            ':sender' => $sender,
            ':recipient' => $recipient,
            ':message' => $message
        ]);
    }
}

$stmt = $pdo->query("SELECT * FROM chat_messages ORDER BY timestamp ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat</title>
</head>
<body>
    <h1>Admin Chat</h1>
    <div>
        <?php foreach ($messages as $msg): ?>
            <div>
                <strong><?php echo ucfirst($msg['sender']); ?>:</strong> <?php echo htmlspecialchars($msg['message']); ?>
                <br><small><?php echo $msg['timestamp']; ?></small>
            </div>
        <?php endforeach; ?>
    </div>
    
    <form action="admin_chat.php" method="post">
        <textarea name="message" rows="3" placeholder="Type your message..." required></textarea>
        <br>
        <button type="submit">Send</button>
    </form>
</body>
</html>

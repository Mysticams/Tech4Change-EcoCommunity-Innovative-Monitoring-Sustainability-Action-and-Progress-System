<?php
// Database connection
$host = 'localhost';
$dbname = 'finalproj';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = 'user';
    $recipient = 'admin';
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
    <title>User Chat</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e4e6eb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        h1 {
            background-color: #0078ff;
            color: white;
            margin: 0;
            padding: 15px;
            text-align: center;
        }

        .messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background-color: #f0f2f5;
        }

        .messages .message {
            max-width: 70%;
            padding: 10px;
            border-radius: 15px;
            line-height: 1.4;
            font-size: 14px;
            display: inline-block;
        }

        .messages .message.sent {
            background-color: #0078ff;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }

        .messages .message.received {
            background-color: #f0f0f0;
            color: #000;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }

        form {
            display: flex;
            padding: 10px;
            background-color: #ffffff;
            border-top: 1px solid #ddd;
        }

        textarea {
            flex: 1;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            font-size: 14px;
            outline: none;
            resize: none;
            background-color: #f0f2f5;
        }

        button {
            background-color: #0078ff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056cc;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>User Chat</h1>
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message <?php echo $msg['sender'] === 'user' ? 'sent' : 'received'; ?>">
                    <?php echo htmlspecialchars($msg['message']); ?>
                    <br><small><?php echo $msg['timestamp']; ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form action="user_chat.php" method="post">
            <textarea name="message" rows="1" placeholder="Type a message..." required></textarea>
            <button type="submit">&#10148;</button>
        </form>
    </div>
</body>
</html>

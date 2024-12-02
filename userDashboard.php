<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        /* General styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img/tech.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Transparent container */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            text-align: center;
            width: 90%;
        }

        /* Heading styles */
        h2 {
            margin: 0 0 20px;
            font-size: 24px;
            color: #333;
            animation: fadeIn 1s ease-in-out;
        }

        /* Links container styles */
        .links {
            display: flex;
            flex-direction: column;
            gap: 15px;
            animation: slideIn 1.2s ease-in-out;
        }

        /* Link styles */
        .links a {
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(90deg, #007bff, #0056b3);
            padding: 10px 20px;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Hover effect for links */
        .links a:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome to User Dashboard!</h2>
        <div class="links">
            <a href="create.php">Create New Action</a>
            <a href="list.php">Project List</a>
            <a href="user_chat.php">User Chat</a>
        </div>
    </div>
</body>
</html>

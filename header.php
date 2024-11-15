<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Tech4Change</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url('tech.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }


        .content {
            text-align: center;
            padding: 100px 20px;
            font-size: 25px;
            color: #ffff99;
            font-family: Corbel;

        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: rgba(172, 225, 175, 0.9);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            margin-left: 10px;
            color: #5417D7;
        }

        .logo h1 span {
            color: magenta;
        }

        /* Navigation Styles */
        ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul li {
            margin-left: 20px;
        }

        ul li a {
            text-decoration: none;
            padding: 10px;
            color: #FF00BF;
            font-size: 18px;
            transition: background 0.3s ease;
        }

        ul li a:hover {
            background-color: #E6E6FA;
            color: rgb(255, 0, 140);
        }

        /* Mobile Menu */
        #menuToggle {
            display: none;
        }

        label[for="menuToggle"] {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        label[for="menuToggle"] div {
            width: 30px;
            height: 4px;
            background-color: #333;
            margin: 5px;
            transition: all 0.3s ease;
        }

        #menuItems {
            display: none;
            flex-direction: column;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 999;
            justify-content: center;
        }

        #menuToggle:checked+label[for="menuToggle"]+#menuItems {
            display: flex;
        }

        #menuItems ul {
            list-style-type: none;
        }

        #menuItems ul li {
            margin: 20px 0;
        }

        #menuItems ul li a {
            color: white;
            text-decoration: none;
            font-size: 24px;
        }

        #menuItems ul li a:hover {
            color: #ff6f61;
        }

        @media (max-width: 768px) {
            ul {
                display: none;
            }

            label[for="menuToggle"] {
                display: flex;
            }

        }
    </style>
</head>

<body>

    <!-- HEADER START -->
    <header>
        <div class="logo">
            <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none">
                <path d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0Z" fill="#5417D7"></path>
            </svg>
            <h1>Tech<span>4</span>Change</h1>
        </div>

        <!-- Mobile Menu Toggle -->
        <input type="checkbox" id="menuToggle">
        <label for="menuToggle">
            <div></div>
            <div></div>
            <div></div>
        </label>

        <!-- Mobile Menu Items -->
        <div id="menuItems">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="action.php">Action</a></li>
                <li><a href="header.php">Return to Homepage</a></li>
            </ul>
        </div>

        <!-- Desktop Navigation Menu -->
        <?php
        $pages = ["Home", "About", "Action"];
        echo '<ul>';
        foreach ($pages as $page) {
            echo '<li><a href="' . strtolower($page) . '.php">' . $page . '</a></li>';
        }
        echo '</ul>';
        ?>
    </header>
    <!-- HEADER END -->

    <!-- Welcome Content -->

    <div class="content">
        <h1>Welcome to Tech4Change!</h1>
        <p>We've developed an Innovative Monitoring Sustainability Action and Progress System
            that <br>enables individuals, organizations, and communities to make informed decisions <br>for a greener future.
            Let's make a difference together through technology.</p>
    </div>


    <div class="hero1">
        <a href="index1.php" class="cta-button">
            <button style="background-color: #008000; color: #FFD47F; padding: 10px 20px; font-family: Corbel; font-weight: bold; font-size: 1.2em; border-radius: 5px; border: none; cursor: pointer; display: block; margin: 0 auto;" onclick="window.history.back()">Get Started</button>
        </a>
    </div>

</body>

</html>
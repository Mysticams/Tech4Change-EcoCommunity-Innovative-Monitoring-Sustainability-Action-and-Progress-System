<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('tech.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .content {
            color: white;
            text-align: center;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #ACE1AF;
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
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
        }

        ul li {
            margin-left: 10px;
        }

        ul li a {
            text-decoration: none;
            padding: 30px;
            color: #FF00BF;
            margin: 0 15px;
            /* Add space between the links */
            text-decoration: none;
            /* Remove underline */
            font-size: 18px;
        }

        ul li a:hover {
            background: #E6E6FA;
            color: rgb(255, 0, 140);
        }

        /* Mobile menu toggle */
        input[type="checkbox"] {
            display: none;
            /* Hide the checkbox */
        }

        /* Menu Icon */
        label[for="menu"] {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            width: 30px;
            height: 25px;
            cursor: pointer;
            padding: 5px;
            position: absolute;
            top: 15px;
            right: 15px;
            /* Left align the hamburger icon */
        }

        label[for="menu"] div {
            width: 100%;
            height: 4px;
            background-color: #333;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        /* Hamburger Icon Transformation when Menu is Open */
        input[type="checkbox"]:checked+label[for="menu"] div:nth-child(1) {
            transform: rotate(45deg);
            position: relative;
            top: 6px;
        }

        input[type="checkbox"]:checked+label[for="menu"] div:nth-child(2) {
            opacity: 0;
            /* Hide the middle bar */
        }

        input[type="checkbox"]:checked+label[for="menu"] div:nth-child(3) {
            transform: rotate(-45deg);
            position: relative;
            top: -6px;
        }

        /* Mobile Menu Container */
        #menuItems {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
            flex-direction: column;
        }

        /* Show the menu when checkbox is checked */
        input[type="checkbox"]:checked+label[for="menu"]+#menuItems {
            display: flex;
        }

        /* Menu Links */
        #menuItems ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        #menuItems ul li {
            margin: 20px 0;
            font-size: 24px;
        }

        #menuItems ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        #menuItems ul li a:hover {
            color: #ff6f61;
            /* Change color on hover */
        }

        /* Responsive Design for Mobile Screens */
        @media (max-width: 768px) {
            body {
                font-size: 16px;
            }

            label[for="menu"] {
                margin: 20px;
            }
        }

        /* Responsive Navigation */
        @media (max-width: 768px) {
            ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                background-color: #f0f0f0;
            }

            ul li {
                text-align: center;
                margin: 10px 0;
            }

            label {
                display: flex;
            }

            input[type="checkbox"]:checked~ul {
                display: flex;
            }

            .return .cta-button {
                background-color: #F9629F;
                color: white;
                padding: 15px 30px;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
            }
        }
    </style>
</head>

<body>


    <!-- HEADER START -->
    <header>
        <div class="logo">
            <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd" d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z" fill="#5417D7"></path>
            </svg>
            <h1>Tech<span>4</span>Change</h1>
        </div>

        <!-- Mobile Menu Toggle Checkbox -->
        <input type="checkbox" id="menu">

        <!-- Hamburger Menu Icon -->
        <label for="menu">
            <div></div>
            <div></div>
            <div></div>
        </label>

        <!-- Menu Items (hidden by default) -->
        <div id="menuItems">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="action.php">Action</a></li>
                <li><a href="header.php">Return to Homepage</a></li>

            </ul>
        </div>


        <!-- NAVIGATION MENU -->
        <?php
        $array = array("Home", "About", "Action");
        echo '<ul>';
        foreach ($array as $key => $value) {
            echo '<li><a href="' . $value . '.php">' . $value . '</a></li>';
        }
        echo '</ul>';
        ?>
    </header>
    <!-- HEADER END -->
</body>

</html>
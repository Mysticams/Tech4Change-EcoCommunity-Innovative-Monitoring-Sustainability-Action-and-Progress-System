<?php $page = 'home';
"include/header.php"; ?>
<hr>

<div class="container">

    <div class="starter-template">
    </div>
    <style>
        html,
        body {
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('bg1.webp');
            /* Path to your image */
            background-size: cover;
            /* Ensures the image covers the entire screen */
            background-position: center;
            /* Centers the image */
            background-repeat: no-repeat;
            /* Prevents image repetition */
            background-attachment: fixed;
            /* Keeps the background image fixed during scrolling */
        }

        .content {
            color: #800080;
            text-align: center;
            padding: 20px;
        }

        .hero {
            background: none;
            text-align: center;
            padding: 20px 20px;
            background-color: #FFC0CB;
            color: #720e9e;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
        }

        .hero h1 {
            font-size: 3em;
        }

        .hero p {
            font-size: 1.5em;
        }

        .hero .cta-button {
            background-color: #F9629F;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
        }
    </style>
    </head>

    <body>

        <button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button>

        <div class="hero">
            <h1>Leading the Charge in Sustainable Development</h1>
            <p>Advanced Monitoring Solutions for Climate Action</p>
            <a href="index.php" class="cta-button">Get Started</a>
        </div>
    </body>

    </html>
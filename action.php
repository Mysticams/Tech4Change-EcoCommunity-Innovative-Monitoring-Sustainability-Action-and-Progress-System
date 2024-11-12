<?php $page = 'action';
"include/header.php"; ?>
<hr>

<div class="container">

    <style>
        html,
        body {
            padding: 0;
            font-family: Times New Roman, sans-serif;
            color: black;

        }

        body {
            background-image: url('bg3.jpg');
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
        }

        .hero h1 {
            font-size: 3em;
        }

        .hero p {
            font-size: 1.5em;
        }

        .hero1 {
            background: none;
            text-align: center;
            padding: 20px 20px;
        }

        .hero1 h1 {
            font-size: 3em;
        }

        .hero1 p {
            font-size: 1.5em;
        }

        .hero1 .cta-button {
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
            <h1>Mission</h1>
            <p>Tech4Change is committed to developing a tech-based system that monitors and enhances the
                <br>sustainability of ecocommunities. Our mission is to deliver practical insights that help<br>
                communities implement and maintain sustainable practices.
            </p>
        </div>

        <div class="hero1">
            <h1>Vision</h1>
            <p>Tech4Change envisions a world where ecocommunities thrive by making informed, sustainable choices.
                <br>We aim to be a leader in ecological innovation, supporting sustainable growth and resilient<br>
                communities through advanced monitoring technology.
            </p>
            <a href="index1.php" class="cta-button">Get Started</a>
        </div>
    </body>

    </html>
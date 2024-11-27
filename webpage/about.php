<?php $page = 'about';
"include/header.php"; ?>
<hr>

<div class="container">

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        <style>
            body,
            html {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: Copperplate;
                background-image: url('img/bg2.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .container {
                text-align: center;
            }

            .container img {
                width: 30%;
                height: auto;
                border-radius: 10px;
            }

            h1 {
                margin-top: 20px;
                font-size: 2.5em;
                color: #ff037d;
                font-family: Copperplate;
                text-align: center;
                background-color: #8cfabf;
                padding: 10px;
                text-decoration: none;
                border-radius: 50px;
            }

            p {
                color: white;
                text-align: center;
                background-color: #F9629F;
                color: white;
                padding: 10px 30px;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <img src="img/about.jpg" alt="About Image">
            <h1>About Us</h1>
            <p>At Tech4Change, we are dedicated to driving sustainability and progress through innovative technology solutions.
                Our eco-community approach empowers individuals and organizations to engage with cutting-edge monitoring systems
                that track environmental impact and foster responsible practices. With a focus on innovation, we provide tools that
                help shape a more sustainable future, ensuring that technology and the environment grow in harmony. At Tech4Change,
                we believe in the power of technology to create lasting, positive change for both people and the planet.</p>
        </div>

        <button style="background-color: #FF00BF; color: white; padding: 5px 10px; text-decoration: none; font-size: 1.0em; border-radius: 5px;" onclick="window.history.back()">Return</button>

    </body>

    </html>
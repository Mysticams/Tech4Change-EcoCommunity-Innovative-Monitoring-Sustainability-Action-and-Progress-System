<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navbar</title>
        <link rel="stylesheet" href="style.css">
        <style>
            /* General Styles */
            html, body {
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
                padding: 10px;
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
                padding: 10px;
                color: #FF00BF;
            }

            ul li a:hover {
                background: #E6E6FA;
                color: rgb(255, 0, 140);
            }

            /* Mobile Menu Styles */
            input[type="checkbox"] {
                display: none;
            }

            label {
                display: none;
                flex-direction: column;
                cursor: pointer;
            }

            label div {
                width: 25px;
                height: 3px;
                background-color: black;
                margin: 5px 0;
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

                input[type="checkbox"]:checked ~ ul {
                    display: flex;
                }
            }
        </style>
    </head>
    <body>
        <!-- MOBILE MENU CHECKBOX -->
        <input type="checkbox" id="menu">

        <!-- HEADER START -->
        <header>
            <div class="logo">
                <svg id="logo-85" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="ccustom" fill-rule="evenodd" clip-rule="evenodd" d="M10 0C15.5228 0 20 4.47715 20 10V0H30C35.5228 0 40 4.47715 40 10C40 15.5228 35.5228 20 30 20C35.5228 20 40 24.4772 40 30C40 32.7423 38.8961 35.2268 37.1085 37.0334L37.0711 37.0711L37.0379 37.1041C35.2309 38.8943 32.7446 40 30 40C27.2741 40 24.8029 38.9093 22.999 37.1405C22.9756 37.1175 22.9522 37.0943 22.9289 37.0711C22.907 37.0492 22.8852 37.0272 22.8635 37.0051C21.0924 35.2009 20 32.728 20 30C20 35.5228 15.5228 40 10 40C4.47715 40 0 35.5228 0 30V20H10C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM18 10C18 14.4183 14.4183 18 10 18V2C14.4183 2 18 5.58172 18 10ZM38 30C38 25.5817 34.4183 22 30 22C25.5817 22 22 25.5817 22 30H38ZM2 22V30C2 34.4183 5.58172 38 10 38C14.4183 38 18 34.4183 18 30V22H2ZM22 18V2L30 2C34.4183 2 38 5.58172 38 10C38 14.4183 34.4183 18 30 18H22Z" fill="#5417D7"></path>
                </svg>
                <h1>Tech<span>4</span>Change</h1>
            </div>

            <!-- MOBILE MENU ICON -->
            <label for="menu">
                <div></div>
                <div></div>
                <div></div>
            </label>

            <!-- NAVIGATION MENU -->
            <?php
                $array = array("Home", "About", "Action");
                echo '<ul>';
                foreach($array as $key=>$value){
                    echo '<li><a href="'.$value.'.php">'.$value.'</a></li>';
                }
                echo '</ul>';
            ?>
        </header>
        <!-- HEADER END -->
    </body>
</html>

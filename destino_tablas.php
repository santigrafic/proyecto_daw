<?php
/*php*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Destination Details</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Sen:wght@400..800&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sen:wght@400..800&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <img id="logo" src="img/logo.png" title="Logo" alt="Website logo" />
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="destinations.php">Destinations</a></li>
                </ul>
            </nav>
            <div style="clear: both"></div>
        </header>

        <section id="destinations">
            <h1>City</h1>
            <h2 class="destination">Country</h2>
            <p id="passport">Passport required: Yes / No</p>

            <h3 class="destination">Assigned Guides</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Speciality</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Example row -->
                <tr>
                    <td>Num</td>
                    <td>Maria</td>
                    <td>López</td>
                    <td>especialidad</td>
                </tr>
                <!--<?php
                /*php*/
                ?>-->
                </tbody>
            </table>

            <h3 class="destination">Registered Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Age</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Example row -->
                <tr>
                    <td>num</td>
                    <td>John</td>
                    <td>Doe</td>
                    <td>15</td>
                    <td>correo@correo.com</td>
                </tr>
                <!--<?php
                /*php*/
                ?>-->
                </tbody>
            </table>
        </section>
    </div>

    <footer>
        <img src="img/logo.png" />
        <p>Enjoy the touring</p>
        <div id="redes_sociales">
            <a href="" target="_blank" id="boton_social_footer">
                <img src="img/facebook.svg" class="icono_social" />
            </a>
            <a href="" target="_blank" id="boton_social_footer">
                <img src="img/instagram.svg" class="icono_social" />
            </a>
            <a href="" target="_blank" id="boton_social_footer">
                <img src="img/twitter.svg" class="icono_social" />
            </a>
            <div style="clear: both"></div>
        </div>
        <p id="firma">Created by the team · 2025</p>
    </footer>
</body>
</html>

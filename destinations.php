<?php
// Aquí iría la conexión con la base de datos
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
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
                    <li><a href="">About us</a></li>
                    <li><a href="destinations.php">Destinations</a></li>
                    <li><a href="">Tours</a></li>
                    <li><a href="">Blog</a></li>
                </ul>
            </nav>
            <a href="" id="boton_book_now">Create New</a>
            <div style="clear: both"></div>
        </header>
        <section id="destinations">
            <h1>Available Destinations</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Passport Required</th>
                        <th>More Info</th>
                    </tr>
                </thead>
                <tbody>
                <!--This section will be generated dynamically with PHP -->
                <?php 
                /*php*/ ?>
                <!-- Ejemplos para ver los estilos -->
                <tr>
                    <td>num</td>
                    <td>Tokyo</td>
                    <td>Japan</td>
                    <td>Yes</td>
                    <td><a href="destino_tablas.php?id=1" class="boton_view_details">View Details</a></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td>Madrid</td>
                    <td>Spain</td>
                    <td>No</td>
                    <td><a href="" class="boton_view_details">View Details</a></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td>Oklahoma</td>
                    <td>EEUU</td>
                    <td>Yes</td>
                    <td><a href="" class="boton_view_details">View Details</a></td>
                </tr>
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
        <p id="firma">Created by the team Â· 2025</p>
    </footer>
</body>
</html>

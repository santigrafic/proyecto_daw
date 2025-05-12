<?php
/*php*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuarios</title>
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
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="destinations.php">Destinos</a></li>
                    <li><a href="usuarios.php">Usuarios</a></li>
                </ul>
            </nav>
            <div style="clear: both"></div>
        </header>

        <section id="usuarios">
            <h1>Listado de Usuarios Registrados</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Correo electrónico</th>
                        <th>Tiene passaporte</th>
                        <th>Modificar usuario</th>
                        <th>Eliminar usuario</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Example row -->
                <tr>
                    <td>num</td>
                    <td>Miguel Angelesdecielocaido</td>
                    <td>Creo</td>
                    <td>15</td>
                    <td>correo@correo.com</td>
                    <td>No</td>
                    <td><a href="" class="boton_modificar">Modificar</a></td>
                    <td><a href="" class="boton_eliminar">Eliminar</a></td>
                </tr>
                   <tr>
                    <td>num</td>
                    <td>Parti</td>
                    <td>Do</td>
                    <td>45</td>
                    <td>imaginatequeesun@correolarguisimo.com</td>
                    <td>Sí</td>
                    <td><a href="" class="boton_modificar">Modificar</a></td>
                    <td><a href="" class="boton_eliminar">Eliminar</a></td>
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
        <p>Disfruta del viaje</p>
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
        <p id="firma">Creado por el equipo · 2025</p>
    </footer>
</body>
</html>
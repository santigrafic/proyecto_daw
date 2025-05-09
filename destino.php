<?php
// Aqu� ir�a la conexi�n a la base de datos
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalle del destino</title>
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
                <img id="logo" src="img/logo.png" title="Logo" alt="Logo de la web" />
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="destinations.php">Destinations</a></li>
                </ul>
            </nav>
            <div style="clear: both"></div>
        </header>

        <section id="destinations">
            <h1>💬 Aquí va el nombre del destino desde PHP</h1>
            <p>💬 Aquí va la ciudad, país y si requiere pasaporte</p>

            <h2>Guías asignados</h2>
            <ul>
                <!-- 🔝 Aquí se imprimirán los guías con un while PHP -->
                <?php /*
                while ($g = $guias->fetch_assoc()) {
                    echo "<li>{$g['nombre']} {$g['apellidos']} - {$g['especialidad']}</li>";
                }
                */ ?>
            </ul>

            <h2>Usuarios inscritos</h2>
            <ul>
                <!-- 🔝 Aquí se imprimirán los usuarios con un while PHP -->
                <?php /*
                while ($u = $usuarios->fetch_assoc()) {
                    echo "<li>{$u['nombre']} {$u['apellidos']}</li>";
                }
                */ ?>
            </ul>
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
        <p id="firma">Creado por el equipo · 2025</p>
    </footer>
</body>
</html>

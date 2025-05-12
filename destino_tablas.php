<?php/*

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include'database.php';

$id_destino = $_GET['id_destino'];
$stmt = $pdo->prepare("SELECT * FROM destino WHERE id_destino = ?");
$stmt->execute([$id_destino]);
$destino = $stmt->fetch(PDO::FETCH_ASSOC);
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ciudad, País</title>
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
                    <li><a href="">Sobre nosotros</a></li>
                    <li><a href="destinations.php">Destinos</a></li>
                    <li><a href="usuarios.php">Usuarios</a></li>
                    <li><a href="guias.php">Guías</a></li>
                </ul>
            </nav>
            <div style="clear: both"></div>
        </header>

        <section id="destinations">
            <h1><?php echo htmlspecialchars($destino['ciudad']) ?></h1>
            <h2 class="destination"><?php echo htmlspecialchars($destino['pais']) ?></h2>
            <p id="passport">¿Requiere Pasaporte? <?php echo htmlspecialchars($destino['requiere_pasaporte'] ? 'Sí' : 'No'); ?></p>
            <h3 class="destination">Guías Asignados</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Especialidad</th>
                    </tr>
                </thead>
                <tbody>
                    <!--This section will be generated dynamically with PHP -->
                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM guias WHERE id_destino = ? ORDER BY id_guia ASC");
                        $stmt->execute([$id_destino]);
                        while ($guias = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($guias['id_guia']) ?></td>
                        <td><?= htmlspecialchars($guias['nombre']) ?></td>
                        <td><?= htmlspecialchars($guias['apellidos']) ?></td>
                        <td><?= htmlspecialchars($guias['especialidad']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h3 class="destination">Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Correo electrónico</th>
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
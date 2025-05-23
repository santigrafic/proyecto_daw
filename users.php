<?php include 'database.php'; ?>

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
                    <!-- <li><a href="">Sobre nosotros</a></li> -->
                    <li><a href="destinations.php">Destinos</a></li>
                    <li><a href="users.php">Usuarios</a></li>
                    <li><a href="guides.php">Guías</a></li>
                </ul>
            </nav>
            <a href="create_user.php" id="boton_book_now">Crear Nuevo</a>
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
                        <th>Pasaporte</th>
                        <th>Modificar usuario</th>
                        <th>Eliminar usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <!--This section will be generated dynamically with PHP -->
                    <?php
                        $stmt = $pdo->query("SELECT u.id_usuario, u.nombre, u.apellidos, u.edad, u.email, p.numero AS num_pasaporte
                                            FROM usuarios u
                                            LEFT JOIN pasaporte p ON u.id_usuario = p.id_usuario
                                            ORDER BY u.id_usuario ASC");
                        while ($usuarios = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($usuarios['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuarios['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuarios['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuarios['edad']) ?></td>
                        <td><?= htmlspecialchars($usuarios['email']) ?></td>
                        <td><?= htmlspecialchars(isset($usuarios['num_pasaporte']) ? $usuarios['num_pasaporte'] : '—') ?></td>
                        <td><a href="edit_user.php?id_usuario=<?= $usuarios['id_usuario'] ?>" class="boton_modificar">Modificar</a></td>
                        <td>
                            <form action="delete_user.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?= $usuarios['id_usuario'] ?>">
                                <button type="submit" class="boton_eliminar" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>                
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
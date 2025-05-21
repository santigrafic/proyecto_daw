<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include'database.php';

$id_destino = $_GET['id_destino'];
$stmt = $pdo->prepare("SELECT * FROM destino WHERE id_destino = ?");
$stmt->execute([$id_destino]);
$destino = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id_usuario = $_POST["registrar_usuario"] ?? '';

  // $errores = false;

  if (!empty($id_usuario)) {
    try {
      // Comprobación previa
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario_elige_destino WHERE id_usuario = ? AND id_destino = ?");
      $stmt->execute([$id_usuario, $id_destino]);
      $yaRegistrado = $stmt->fetchColumn();

      if ($yaRegistrado > 0) {
        $msg = "Ese usuario ya está registrado en este destino.";
        } else {
            // Validar si requiere pasaporte
            if ($destino['requiere_pasaporte']) {
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM pasaporte WHERE id_usuario = ?");
                $stmt->execute([$id_usuario]);
                $tienePasaporte = $stmt->fetchColumn();

                if ($tienePasaporte == 0) {
                    $msg = "Este destino requiere pasaporte. El usuario seleccionado no lo tiene.";
                } else {
                    // Tiene pasaporte, insertamos
                    $pdo->beginTransaction();
                    $stmt = $pdo->prepare("INSERT INTO usuario_elige_destino (id_usuario, id_destino) VALUES (?, ?)");
                    $stmt->execute([$id_usuario, $id_destino]);
                    $pdo->commit();
                    header("Location: destination_tables.php?id_destino=" . $id_destino);
                    exit;
                }
            } else {
                // No requiere pasaporte, insertamos directamente
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("INSERT INTO usuario_elige_destino (id_usuario, id_destino) VALUES (?, ?)");
                $stmt->execute([$id_usuario, $id_destino]);
                $pdo->commit();
                header("Location: destination_tables.php?id_destino=" . $id_destino);
                exit;
            }
        }

    } catch (PDOException $e) {
      $pdo->rollBack(); // Deshace todo lo anterior
      $msg = $e->getMessage();
    }

  }
}

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
                    <!-- <li><a href="">Sobre nosotros</a></li> -->
                    <li><a href="destinations.php">Destinos</a></li>
                    <li><a href="users.php">Usuarios</a></li>
                    <li><a href="guides.php">Guías</a></li>
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

            <section id="user_destination_form">
                <form method="POST" onsubmit="return validateForm()" novalidate>
                    <h3>Registrar usuario en este destino</h3>
                    <select name="registrar_usuario" id="registro" required>
                        <option disabled selected hidden value="">Selecciona el usuario que quieres registrar</option>
                        <?php
                            $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id_usuario ASC");
                            while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                        <option value = "<?= htmlspecialchars($usuario['id_usuario']) ?>"><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    <?php if (!empty($msg)): ?>
                        <div style="color: red; margin-bottom: 1em;">
                            <br><br><?= htmlspecialchars($msg) ?>
                        </div>
                    <?php endif; ?>
                    <br><br>
                    <button class="boton_formularios" type="submit">REGISTRAR</button>
                </form>
                <div style="clear: both"></div>
            </section>
            <h3 class="destination">Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Correo electrónico</th>
                        <th>Pasaporte</th>
                    </tr>
                </thead>
                <tbody>
                <!--This section will be generated dynamically with PHP -->
                    <?php
                        $stmt = $pdo->prepare("SELECT u.id_usuario, u.nombre, u.apellidos, u.edad, u.email, p.numero AS num_pasaporte
                                            FROM usuarios u
                                            JOIN usuario_elige_destino ued ON u.id_usuario = ued.id_usuario 
                                            LEFT JOIN pasaporte p ON u.id_usuario = p.id_usuario
                                            WHERE ued.id_destino = ?
                                            ORDER BY u.id_usuario ASC");
                        $stmt->execute([$id_destino]);
                        while ($usuarios = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($usuarios['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuarios['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuarios['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuarios['edad']) ?></td>
                        <td><?= htmlspecialchars($usuarios['email']) ?></td>
                        <td><?= htmlspecialchars(isset($usuarios['num_pasaporte']) ? $usuarios['num_pasaporte'] : '—') ?></td>
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
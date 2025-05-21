<?php include 'database.php';



// Inicializar variables
$nombre = $apellidos = $especialidad_guia = $destino_asignado = '';
$nombre_error = $apellidos_error = $especialidad_guia_error = $destino_asignado_error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre_guia"] ?? '';
  $apellidos = $_POST["apellidos_guia"] ?? '';
  $especialidad_guia = $_POST["especialidad_guia"] ?? '';
  $destino_asignado = $_POST["destino_asignado"] ?? '';

  // Normalización
  $nombre = htmlspecialchars(ucwords(strtolower(trim($nombre))));
  $apellidos = htmlspecialchars(ucwords(strtolower(trim($apellidos))));

  $errores = false;

  // Validaciones backend
  if (empty($nombre)) {
    $nombre_error = "El nombre es obligatorio.";
    $errores = true;
  }

  if (empty($apellidos)) {
    $apellidos_error = "Los apellidos son obligatorios.";
    $errores = true;
  }

  if (!$errores) {
    try {
      $pdo->beginTransaction();

      $stmt = $pdo->prepare("INSERT INTO guias (nombre, apellidos, especialidad, id_destino) VALUES (?, ?, ?, ?)");
      $stmt->execute([$nombre, $apellidos, $especialidad_guia, $destino_asignado]);      

      $pdo->commit();
      header("Location: guides.php");
      exit;
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
    <title>Crear un Nuevo Guía</title>
    <meta name="description" content="Web de agencia de viajes" />
    <meta
      name="keywords"
      content="travel, places, destinations, lovely, popular destinations, newsletter, daw"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Santiago Gavilan" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Sen:wght@400..800&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sen:wght@400..800&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <header>
        <nav>
          <img id="logo" src="img/logo.png" title="Logo" alt="Logo de la web" />
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
      
      <section id="guides_form">
      <form method="POST" onsubmit="return validateForm()" novalidate>
          <h3>Crea un nuevo guía</h3>
          <p>Introduce el nombre y apellido, la especialidad y su ciudad asignada</p>
          <input type="text" name="nombre_guia" placeholder="Introduce aquí el nombre del guía" required/>
          <br><br><div id="nombre_guiaError"></div><br>
          <input type="text" name="apellidos_guia" placeholder="Introduce aquí el apellido del guía" required/>
          <br><br><div id="apellidos_guiaError"></div><br>
            <select name="especialidad_guia" id="especialidad" required>
              <option disabled selected hidden value="">Introduce aquí la especialidad del guia</option>
              <option value="Geografía">Geografía</option>
              <option value="Historia">Historia</option>
              <option value="Arquitectura">Arquitectura</option>
              <option value="Comida">Gastronomia</option>
            </select>
          <br><br><div id="especialidad_guiaError"></div><br>
          <select name="destino_asignado" id="destino" required>
            <?php
                $stmt = $pdo->query("SELECT * FROM destino ORDER BY id_destino ASC");
                while ($destino = $stmt->fetch(PDO::FETCH_ASSOC)):
            ?>
            <option disabled selected hidden value="">Introduce aquí el destino asignado del guia</option>
            <option value = "<?= htmlspecialchars($destino['id_destino']) ?>"><?= htmlspecialchars($destino['ciudad']) ?></option>
            <?php endwhile; ?>
          </select>
          <br><br><div id="destinoAsignado_guiaError"></div><br>
          <button class="boton_formularios" type="submit">AÑADIR GUÍA</button>
        </form>
        <div style="clear: both"></div>
      </section>
      <?php if (!empty($msg)): ?>
  <div class="error mensaje-error">
    <strong>Error:</strong> <?= htmlspecialchars($msg) ?>
  </div>
<?php endif; ?>
    </div>
    <footer>
      <img src="img/logo.png" />
      <p>Drisfruta del viaje</p>
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

    <script>
      function validateForm() {
        const nombre_guiaInput = document.querySelector('input[name="nombre_guia"]');
        const nombre_guiaError = document.getElementById('nombre_guiaError');
        const apellidos_guiaInput = document.querySelector('input[name="apellidos_guia"]');
        const apellidos_guiaError = document.getElementById('apellidos_guiaError');
        const especialidad_guiaInput = document.querySelector('select[name="especialidad_guia"]');
        const especialidad_guiaError = document.getElementById('especialidad_guiaError');
        const destinoAsignado_guiaInput = document.querySelector('input[name="destino_asignado"]');
        const destinoAsignado_guiaError = document.getElementById('destinoAsignado_guiaError');

        let isValid = true;

        nombre_guiaError.textContent = '';
        if (nombre_guiaInput.value.trim() === '') {
          nombre_guiaError.textContent = 'El nombre del guía es obligatorio.';
          isValid = false;
        } else if (nombre_guiaInput.value.trim().length < 3) {
          nombre_guiaError.textContent = 'El nombre del guía debe tener al menos 3 caracteres.';
          isValid = false;
        }

        apellidos_guiaError.textContent = '';
        if (apellidos_guiaInput.value.trim() === '') {
          apellidos_guiaError.textContent = 'Los apellidos del guía son obligatorios.';
          isValid = false;
        } else if (apellidos_guiaInput.value.trim().length < 3) {
          apellidos_guiaError.textContent = 'Los apellidos del guía deben tener al menos 3 caracteres.';
          isValid = false;
        }

        especialidad_guiaError.textContent = '';
        if (especialidad_guiaInput.value.trim() === '') {
          especialidad_guiaError.textContent = 'La especialidad del guía es obligatoria.';
          isValid = false;
        }

        destinoAsignado_guiaError.textContent = '';
        if (destinoAsignado_guiaInput.value.trim() === '') {
          destinoAsignado_guiaError.textContent = 'El guía debe tener un destino asociado.';
          isValid = false;
        }

        return isValid;
      }
</script>

  </body>
</html>
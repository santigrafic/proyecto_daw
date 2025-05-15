<?php include 'database.php';

// Inicializar variables
$nombre = $apellidos = $edad = $email = '';
$numero_pasaporte = $pais_expedicion = '';
$nombre_error = $apellido_error = $edad_error = $email_error = $pasaporte_error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre_guia"] ?? '';
  $apellido = $_POST["apellido_guia"] ?? '';
  $especialidad_guia = $_POST["especialidad_guia"] ?? '';
  $email = $_POST["email"] ?? '';
  $numero_pasaporte = $_POST["numero_pasaporte"] ?? '';
  $pais_expedicion = $_POST["pais_expedicion"] ?? '';

  // Normalización
  $email = strtolower(trim($email));
  $nombre = ucwords(strtolower(trim($nombre)));
  $apellidos = ucwords(strtolower(trim($apellidos)));

  $errores = false;

  // Validaciones backend
  if (empty($nombre)) {
    $nombre_error = "El nombre es obligatorio.";
    $errores = true;
  }

  if (empty($apellidos)) {
    $apellido_error = "El apellido es obligatorio.";
    $errores = true;
  }

  if (empty($edad) || !is_numeric($edad) || (int)$edad < 18) {
    $edad_error = "Debe tener al menos 18 años.";
    $errores = true;
  }

  if (empty($email)) {
    $email_error = "El correo electrónico es obligatorio.";
    $errores = true;
  }

  if ((!empty($numero_pasaporte) && empty($pais_expedicion)) ||
      (empty($numero_pasaporte) && !empty($pais_expedicion))) {
    $pasaporte_error = "Si vas a rellenar datos del pasaporte, completa ambos campos.";
    $errores = true;
  }

  if (!$errores) {
    try {
      $pdo->beginTransaction();

      $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, edad, email) VALUES (?, ?, ?, ?)");
      $stmt->execute([$nombre, $apellidos, $edad, $email]);

      if (!empty($numero_pasaporte) && !empty($pais_expedicion)) {
        $idUsuario = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO pasaporte (numero, pais_expedicion, id_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$numero_pasaporte, $pais_expedicion, $idUsuario]);
      }

      $pdo->commit();
      header("Location: usuarios.php");
      exit;
    } catch (PDOException $e) {
      $pdo->rollBack(); // Deshace todo lo anterior
      $msg = $e->getMessage();

      if (str_contains($msg, 'pk_pasaporte')) {
        $pasaporte_error = "Ese número de pasaporte ya está registrado.";
      } elseif (str_contains($msg, 'pasaporte_id_usuario_key')) {
        $pasaporte_error = "Este usuario ya tiene un pasaporte asignado.";
      } elseif (str_contains($msg, 'uq_usuarios_email')) {
        $email_error = "Ese correo electrónico ya está en uso.";
      } else {
        $pasaporte_error = "Error inesperado: " . htmlspecialchars($msg);
      }
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
            <li><a href="">Sobre nosotros</a></li>
            <li><a href="destinations.php">Destinos</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="guias.php">Guías</a></li>
          </ul>
        </nav>
        <div style="clear: both"></div>
      </header>
      
      <section id="destinos_form">
      <form method="POST" onsubmit="return validateForm()" novalidate>
          <h3>Crea un nuevo guía</h3>
          <p>Introduce el nombre y apellido, la especialidad y su ciudad asignada</p>
          <input type="text" name="nombre_guia" placeholder="Introduce aquí el nombre del guía" required/>
          <br><br><div id="nombre_guiaError"></div><br>
          <input type="text" name="apellido_guia" placeholder="Introduce aquí el apellido del guía" required/>
          <br><br><div id="apellido_guiaError"></div><br>
          <label for="especialidad">Especialidad</label>
            <select name="especialidad_guia" id="especialidad">
              <option value="geografía">Geografía</option>
              <option value="historia">Historia</option>
              <option value="gastronomia">Gastronomía</option>
              <option value="entretenimiento">Entretenimiento</option>
              <option value="musica">Música</option>
            </select>
          <br><br><div id="especialidad_guiaError"></div><br>
          <input type="text" name="pais_asignado" placeholder="Introduce aquí el destino asignado del guía" required/>
          <br><br><div id="paisAsignado_guiaError"></div><br>
          <button class="boton_formularios" type="submit">AÑADIR GUÍA</button>
        </form>
        <div style="clear: both"></div>
      </section>
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
        const nombre_guiaError = document.getElementById('nombre_guíaError');
        const apellido_guiaInput = document.querySelector('input[name="apellido_guia"]');
        const apellido_guiaError = document.getElementById('apellido_guiaError');
        const especialidad_guiaInput = document.querySelector('input[name="especialidad_guia"]');
        const especialidad_guiaError = document.getElementById('especialidad_guiaError');
        const paisAsignado_guiaInput = document.querySelector('input[name="pais_asignado"]');
        const paisAsignado_guiaError = document.getElementById('paisAsignado_guiaError');

        let isValid = true;

        nombre_guiaError.textContent = '';
        if (nombre_guiaInput.value.trim() === '') {
          nombre_guiaError.textContent = 'El nombre del guía es obligatorio.';
          isValid = false;
        } else if (nombre_guiaInput.value.trim().length < 3) {
          nombre_guiaError.textContent = 'El nombre del guía debe tener al menos 3 caracteres.';
          isValid = false;
        }

        apellido_guiaError.textContent = '';
        if (apellido_guiaInput.value.trim() === '') {
          apellido_guiaError.textContent = 'El apellido del guía es obligatorio.';
          isValid = false;
        } else if (apellido_guiaInput.value.trim().length < 3) {
          apellido_guiaError.textContent = 'El apellido del guía debe tener al menos 3 caracteres.';
          isValid = false;
        }

        especialidad_guiaError.textContent = '';
        if (especialidad_guiaInput.value.trim() === '') {
          especialidad_guiaError.textContent = 'El la especialidad del guía es obligatorio.';
          isValid = false;
        } else if (especialidad_guiaInput.value.trim().length < 3) {
          especialidad_guiaError.textContent = 'Le especialidad del guía debe tener al menos 3 caracteres.';
          isValid = false;
        }

        paisAsignado_guiaError.textContent = '';
        if (paisAsignado_guiaInput.value.trim() === '') {
          paisAsignado_guiaError.textContent = 'El guía debe tener un destino asociado.';
          isValid = false;
        } else if (paisAsignado_guiaInput.value.trim().length < 3) {
          paisAsignado_guiaError.textContent = 'El destino asociado al guía debe tener al menos 3 caracteres.';
          isValid = false;
        }

        return isValid;
      }
</script>

  </body>
</html>
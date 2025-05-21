<?php
session_start();
include 'database.php';

// Inicializar variables
$nombre = $apellidos = $edad = $email = $numero_pasaporte = $pais_expedicion = '';
$nombre_error = $apellido_error = $edad_error = $email_error = $pasaporte_error = '';
$pasaporte = null;

if (!isset($_GET['id_usuario'])) {
  exit("<p style='color:red;'>ID de usuario no especificado.</p>");
}

$id_usuario = $_GET['id_usuario'];

// Obtener datos del usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
  exit("<p style='color:red;'>Usuario no encontrado.</p>");
}

$stmt = $pdo->prepare("SELECT * FROM pasaporte WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$pasaporte = $stmt->fetch(PDO::FETCH_ASSOC);

// Precargar datos si no es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  $nombre = $usuario['nombre'];
  $apellidos = $usuario['apellidos'];
  $edad = $usuario['edad'];
  $email = $usuario['email'];
  if ($pasaporte) {
    $numero_pasaporte = $pasaporte['numero'];
    $pais_expedicion = $pasaporte['pais_expedicion'];
  }
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre_usuario"] ?? '';
  $apellidos = $_POST["apellido_usuario"] ?? '';
  $edad = $_POST["edad"] ?? '';
  $email = $_POST["email"] ?? '';
  $numero_pasaporte = $_POST["numero_pasaporte"] ?? '';
  $pais_expedicion = $_POST["pais_expedicion"] ?? '';

  // Normalización
  $email = strtolower(trim($email));
  $nombre = ucwords(strtolower(trim($nombre)));
  $apellidos = ucwords(strtolower(trim($apellidos)));

  $errores = false;

  // Validación backend
  if (empty($nombre)) {
    $nombre_error = "El nombre es obligatorio.";
    $errores = true;
  }

  if (empty($apellidos)) {
    $apellido_error = "El apellido es obligatorio.";
    $errores = true;
  }

  if (empty($edad) || !is_numeric($edad) || (int)$edad < 18) {
    $edad_error = "Debes tener al menos 18 años.";
    $errores = true;
  }

  if (empty($email)) {
    $email_error = "El email es obligatorio.";
    $errores = true;
  }

  if ((!empty($numero_pasaporte) && empty($pais_expedicion)) ||
      (empty($numero_pasaporte) && !empty($pais_expedicion))) {
    $pasaporte_error = "Si vas a rellenar datos del pasaporte, completa ambos campos.";
    $errores = true;
  }

  if (!$errores) {
    try {
      $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, edad = ?, email = ? WHERE id_usuario = ?");
      $stmt->execute([$nombre, $apellidos, $edad, $email, $id_usuario]);

      if (!empty($numero_pasaporte) && !empty($pais_expedicion)) {
        if ($pasaporte) {
          $stmt = $pdo->prepare("UPDATE pasaporte SET numero = ?, pais_expedicion = ? WHERE id_usuario = ?");
          $stmt->execute([$numero_pasaporte, $pais_expedicion, $id_usuario]);
        } else {
          $stmt = $pdo->prepare("INSERT INTO pasaporte (numero, pais_expedicion, id_usuario) VALUES (?, ?, ?)");
          $stmt->execute([$numero_pasaporte, $pais_expedicion, $id_usuario]);
        }
      }

      header("Location: users.php");
      exit;
    } catch (PDOException $e) {
      $msg = $e->getMessage();

      if (str_contains($msg, 'uq_usuarios_email')) {
        $email_error = "Ese correo electrónico ya está en uso.";
      } elseif (str_contains($msg, 'pk_pasaporte')) {
        $pasaporte_error = "Ese número de pasaporte ya está registrado.";
      } elseif (str_contains($msg, 'pasaporte_id_usuario_key')) {
        $pasaporte_error = "Este usuario ya tiene un pasaporte asignado.";
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
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
  <div class="container">
    <header>
      <nav>
        <img id="logo" src="img/logo.png" />
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <!-- <li><a href="">Sobre nosotros</a></li> -->
          <li><a href="destinations.php">Destinos</a></li>
          <li><a href="users.php">Usuarios</a></li>
          <li><a href="guides.php">Guías</a></li>
        </ul>
      </nav>
    </header>

    <section id="edit_user_form">
      <form method="POST" onsubmit="return validateForm()" novalidate>
        <h3>Editar usuario</h3>

        <input type="text" name="nombre_usuario" value="<?= htmlspecialchars($nombre) ?>" placeholder="Nombre del usuario" required /><br><br>
        <div id="nombre_usuarioError" style="color:red;">
          <?= $nombre_error ?>
        </div><br>

        <input type="text" name="apellido_usuario" value="<?= htmlspecialchars($apellidos) ?>" placeholder="Apellidos del usuario" required /><br><br>
        <div id="apellido_usuarioError" style="color:red;">
          <?= $apellido_error ?>
        </div><br>

        <input type="number" name="edad" value="<?= htmlspecialchars($edad) ?>" placeholder="Edad del usuario" required /><br><br>
        <div id="edad_usuarioError" style="color:red;">
          <?= $edad_error ?>
        </div><br>

        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Email del usuario" required /><br><br>
        <div id="email_usuarioError" style="color:red;">
          <?= $email_error ?>
        </div><br>

        <hr>
        <p>Datos del pasaporte (opcional)</p>

        <input type="text" name="numero_pasaporte" value="<?= htmlspecialchars($numero_pasaporte) ?>" placeholder="Número de pasaporte" /><br><br>
        <input type="text" name="pais_expedicion" value="<?= htmlspecialchars($pais_expedicion) ?>" placeholder="País de expedición" /><br><br>
        <div id="pasaporteError" style="color:red;">
          <?= $pasaporte_error ?>
        </div><br>

        <button class="boton_formularios" type="submit">GUARDAR CAMBIOS</button>
      </form>
    </section>
  </div>

  <footer>
    <img src="img/logo.png" />
    <p>Disfruta del viaje</p>
    <p id="firma">Creado por el equipo · 2025</p>
  </footer>

  <script>
    function validateForm() {
      const nombreInput = document.querySelector('input[name="nombre_usuario"]');
      const apellidoInput = document.querySelector('input[name="apellido_usuario"]');
      const edadInput = document.querySelector('input[name="edad"]');
      const emailInput = document.querySelector('input[name="email"]');

      let isValid = true;

      document.getElementById('nombre_usuarioError').textContent = '';
      if (nombreInput.value.trim() === '') {
        document.getElementById('nombre_usuarioError').textContent = 'El nombre es obligatorio.';
        isValid = false;
      }

      document.getElementById('apellido_usuarioError').textContent = '';
      if (apellidoInput.value.trim() === '') {
        document.getElementById('apellido_usuarioError').textContent = 'El apellido es obligatorio.';
        isValid = false;
      }

      document.getElementById('edad_usuarioError').textContent = '';
      if (edadInput.value.trim() === '' || isNaN(edadInput.value) || parseInt(edadInput.value) < 18) {
        document.getElementById('edad_usuarioError').textContent = 'Debes tener al menos 18 años.';
        isValid = false;
      }

      document.getElementById('email_usuarioError').textContent = '';
      if (emailInput.value.trim() === '') {
        document.getElementById('email_usuarioError').textContent = 'El correo es obligatorio.';
        isValid = false;
      }

      return isValid;
    }

    function validatePasaporteFields() {
      const numero = document.querySelector('input[name="numero_pasaporte"]').value.trim();
      const pais = document.querySelector('input[name="pais_expedicion"]').value.trim();
      const errorDiv = document.getElementById('pasaporteError');
      const submitButton = document.querySelector('button[type="submit"]');

      if ((numero && !pais) || (!numero && pais)) {
        errorDiv.textContent = "Si vas a rellenar datos del pasaporte, completa ambos campos.";
        submitButton.disabled = true;
      } else {
        errorDiv.textContent = "";
        submitButton.disabled = false;
      }
    }

    document.querySelector('input[name="numero_pasaporte"]').addEventListener('input', validatePasaporteFields);
    document.querySelector('input[name="pais_expedicion"]').addEventListener('input', validatePasaporteFields);
  </script>
</body>
</html>

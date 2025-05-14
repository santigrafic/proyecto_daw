<?php
session_start();
include 'database.php';

// Inicializar variables
$nombre = $apellidos = $edad = $email = '';
$numero_pasaporte = $pais_expedicion = '';
$email_error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre_usuario"] ?? '';
  $apellidos = $_POST["apellido_usuario"] ?? '';
  $edad = $_POST["edad"] ?? '';
  $email = $_POST["email"] ?? '';
  $numero_pasaporte = $_POST["numero_pasaporte"] ?? '';
  $pais_expedicion = $_POST["pais_expedicion"] ?? '';

  if ((!empty($numero_pasaporte) && empty($pais_expedicion)) ||
      (empty($numero_pasaporte) && !empty($pais_expedicion))) {
    echo "<p style='color:red;'>Si vas a rellenar datos del pasaporte, completa ambos campos.</p>";
  } else {
    try {
      $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, edad, email) VALUES (?, ?, ?, ?)");
      $stmt->execute([$nombre, $apellidos, $edad, $email]);

      if (!empty($numero_pasaporte) && !empty($pais_expedicion)) {
        $idUsuario = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO pasaporte (numero, pais_expedicion, id_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$numero_pasaporte, $pais_expedicion, $idUsuario]);
      }

      header("Location: usuarios.php");
      exit;
    } catch (PDOException $e) {
      $msg = $e->getMessage();

      if (str_contains($msg, 'pk_pasaporte')) {
        echo "<p style='color:red;'>Ese número de pasaporte ya está registrado. Usa uno diferente.</p>";
      } elseif (str_contains($msg, 'pasaporte_id_usuario_key')) {
        echo "<p style='color:red;'>Este usuario ya tiene un pasaporte asignado.</p>";
      } elseif (str_contains($msg, 'uq_usuarios_email')) {
        $email_error = "Ese correo electrónico ya está en uso.";
      } else {
        echo "<p style='color:red;'>Error inesperado: " . htmlspecialchars($msg) . "</p>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
  <div class="container">
    <header>
      <nav>
        <img id="logo" src="img/logo.png" />
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="#">Sobre nosotros</a></li>
          <li><a href="destinations.php">Destinos</a></li>
          <li><a href="usuarios.php">Usuarios</a></li>
          <li><a href="guias.php">Guías</a></li>
        </ul>
      </nav>
    </header>

    <section id="destinos_form">
      <form method="POST" onsubmit="return validateForm()" novalidate>
        <h3>Crea un nuevo usuario</h3>

        <input type="text" name="nombre_usuario" value="<?= htmlspecialchars($nombre) ?>" placeholder="Nombre del usuario" required /><br><br>
        <div id="nombre_usuarioError" style="color:red;"></div><br>

        <input type="text" name="apellido_usuario" value="<?= htmlspecialchars($apellidos) ?>" placeholder="Apellidos del usuario" required /><br><br>
        <div id="apellido_usuarioError" style="color:red;"></div><br>

        <input type="text" name="edad" value="<?= htmlspecialchars($edad) ?>" placeholder="Edad del usuario" required /><br><br>
        <div id="edad_usuarioError" style="color:red;"></div><br>

        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Email del usuario" required /><br><br>
        <div id="email_usuarioError" style="color:red;">
          <?= $email_error ?>
        </div><br>

        <hr>
        <p>Datos del pasaporte (opcional)</p>
        <input type="text" name="numero_pasaporte" value="<?= htmlspecialchars($numero_pasaporte) ?>" placeholder="Número de pasaporte (opcional)" /><br><br>
        <input type="text" name="pais_expedicion" value="<?= htmlspecialchars($pais_expedicion) ?>" placeholder="País de expedición (opcional)" /><br><br>
        <div id="pasaporteError" style="color:red;"></div><br>

        <button class="boton_formularios" type="submit">AÑADIR USUARIO</button>
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
        document.getElementById('edad_usuarioError').textContent = 'Debe tener al menos 18 años.';
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

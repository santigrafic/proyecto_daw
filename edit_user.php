<?php
session_start();
include 'database.php';

// Verificamos el ID
if (!isset($_GET['id_usuario'])) {
  echo "<p style='color:red;'>ID de usuario no especificado.</p>";
  exit;
}

$id_usuario = $_GET['id_usuario'];

// Obtenemos el usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
  echo "<p style='color:red;'>Usuario no encontrado.</p>";
  exit;
}

// Obtenemos su pasaporte (si tiene)
$stmt = $pdo->prepare("SELECT * FROM pasaporte WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$pasaporte = $stmt->fetch(PDO::FETCH_ASSOC);

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["nombre_usuario"];
  $apellidos = $_POST["apellido_usuario"];
  $edad = $_POST["edad"];
  $email = $_POST["email"];
  $numero_pasaporte = $_POST["numero_pasaporte"];
  $pais_expedicion = $_POST["pais_expedicion"];

  // Validación: si uno está lleno pero el otro no
  if ((!empty($numero_pasaporte) && empty($pais_expedicion)) || 
      (empty($numero_pasaporte) && !empty($pais_expedicion))) {
    echo "<p style='color:red'>Si vas a rellenar datos del pasaporte, completa ambos campos.</p>";
    exit;
  }

  try {
    // Actualizar usuario
    $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, edad = ?, email = ? WHERE id_usuario = ?");
    $stmt->execute([$nombre, $apellidos, $edad, $email, $id_usuario]);

    // Insertar o actualizar pasaporte
    if (!empty($numero_pasaporte) && !empty($pais_expedicion)) {
      if ($pasaporte) {
        // Ya tenía pasaporte → actualizar
        $stmt = $pdo->prepare("UPDATE pasaporte SET numero = ?, pais_expedicion = ? WHERE id_usuario = ?");
        $stmt->execute([$numero_pasaporte, $pais_expedicion, $id_usuario]);
      } else {
        // No tenía → insertar nuevo
        $stmt = $pdo->prepare("INSERT INTO pasaporte (numero, pais_expedicion, id_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$numero_pasaporte, $pais_expedicion, $id_usuario]);
      }
    }

    header("Location: usuarios.php");
    exit;
  } catch (PDOException $e) {
    echo "<p style='color:red;'>Error al actualizar datos: " . htmlspecialchars($e->getMessage()) . "</p>";
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
        <img id="logo" src="img/logo.png" title="Logo" alt="Logo de la web" />
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="#">Sobre nosotros</a></li>
          <li><a href="destinations.php">Destinos</a></li>
          <li><a href="usuarios.php">Usuarios</a></li>
          <li><a href="guias.php">Guías</a></li>
        </ul>
      </nav>
      <div style="clear: both"></div>
    </header>

    <section id="destinos_form">
      <form method="POST">
        <h3>Editar usuario</h3>

        <input type="text" name="nombre_usuario" value="<?= htmlspecialchars($usuario['nombre']) ?>" required />
        <br><br>

        <input type="text" name="apellido_usuario" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required />
        <br><br>

        <input type="number" name="edad" value="<?= htmlspecialchars($usuario['edad']) ?>" required />
        <br><br>

        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required />
        <br><br>

        <hr>
        <p>Datos del pasaporte (opcional)</p>

        <input type="text" name="numero_pasaporte" placeholder="Número de pasaporte" 
          value="<?= $pasaporte ? htmlspecialchars($pasaporte['numero']) : '' ?>" />
        <br><br>

        <input type="text" name="pais_expedicion" placeholder="País de expedición" 
          value="<?= $pasaporte ? htmlspecialchars($pasaporte['pais_expedicion']) : '' ?>" />
        <br><br>

        <div id="pasaporteError" style="color:red;"></div><br>

        <button class="boton_formularios" type="submit">GUARDAR CAMBIOS</button>
      </form>
      <div style="clear: both"></div>
    </section>
  </div>

  <footer>
    <img src="img/logo.png" />
    <p>Disfruta del viaje</p>
    <p id="firma">Creado por el equipo · 2025</p>
  </footer>

  <script>
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

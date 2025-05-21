<?php
session_start();

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ciudad_destino = trim($_POST['ciudad_destino']);//trim() elimina los espacios en blanco del principio y del final del texto.
    $pais_destino = trim($_POST['pais_destino']);
    $pasaporte = $_POST['pasaporte'];

    // Validación del lado del servidor
    $errors = [];

    if (empty($ciudad_destino)) {
        $errors[] = "El nombre de la ciudad es obligatorio.";
    } elseif (strlen($ciudad_destino) < 3) {
        $errors[] = "El nombre de la ciudad debe tener al menos 3 caracteres.";
    }

    if (empty($pais_destino)) {
      $errors[] = "El nombre del pais es obligatorio.";
  } elseif (strlen($pais_destino) < 3) {
      $errors[] = "El nombre del pais debe tener al menos 3 caracteres.";
  }

    if (empty($errors)) {
        // Solo procesar si no hay errores y guardar en base de datos
          $stmt = $pdo->prepare("INSERT INTO destino (ciudad, pais, requiere_pasaporte) VALUES (?, ?, ?)");
          $stmt->execute([$ciudad_destino, $pais_destino, $pasaporte]);
          header("Location: destinations.php");
          exit;
        } else {
          $_SESSION['errors'] = $errors;//guarda los errores para la siguiente página/redireccion
          header("Location: create_destinations.php"); // Redirigir de vuelta al formulario
          exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Crear un Nuevo Destino</title>
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
      
      <section id="destinations_form">
      <form method="POST" onsubmit="return validateForm()" novalidate>
          <h3>Crea un nuevo destino</h3>
          <p>Introduce la ciudad, el pais al que pertenece y si requiere pasaporte.</p>
          <input type="text" name="ciudad_destino" placeholder="Introduce aquí la ciudad de destino" required/>
          <br><br><div id="ciudad_destinoError"></div><br>
          <input type="text" name="pais_destino" placeholder="Introduce aquí el pais del destino" required/>
          <br><br><div id="pais_destinoError"></div><br>
          <p>¿Requiere pasaporte?</p>
          <div class= "input_type_radio">
            <input type="radio" id="pasaporte_si" name="pasaporte" value="true"><label for="pasaporte_si">SI</label><br>
            <input type="radio" id="pasaporte_no" name="pasaporte" value="false"><label for="pasaporte_no">NO</label><br><br>
          </div>
          <button class="boton_formularios" type="submit">AÑADIR DESTINO</button>
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
  const ciudad_destinoInput = document.querySelector('input[name="ciudad_destino"]');
  const ciudad_destinoError = document.getElementById('ciudad_destinoError');
  const pais_destinoInput = document.querySelector('input[name="pais_destino"]');
  const pais_destinoError = document.getElementById('pais_destinoError');
  let isValid = true;

  ciudad_destinoError.textContent = '';

  if (ciudad_destinoInput.value.trim() === '') {
    ciudad_destinoError.textContent = 'El nombre de la ciudad es obligatorio.';
    isValid = false;
  } else if (ciudad_destinoInput.value.trim().length < 3) {
    ciudad_destinoError.textContent = 'El nombre de la ciudad debe tener al menos 3 caracteres.';
    isValid = false;
  }

  pais_destinoError.textContent = '';
  if (pais_destinoInput.value.trim() === '') {
    pais_destinoError.textContent = 'El nombre del pais es obligatorio.';
    isValid = false;
  } else if (pais_destinoInput.value.trim().length < 3) {
    pais_destinoError.textContent = 'El nombre del pais debe tener al menos 3 caracteres.';
    isValid = false;
  }

  return isValid;
}
</script>

  </body>
</html>
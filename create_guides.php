<?php include 'database.php'; ?>
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
          <input type="text" name="especialidad_guia" placeholder="Introduce aquí la especialidad del guía" required/>
          <br><br><div id="especialidad_guiaError"></div><br>
          <input type="text" name="pais_asignado" placeholder="Introduce aquí el país asignado del guía" required/>
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
  const pais_asignadoInput = document.querySelector('input[name="pais_asignado"]');
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
  if (pais_asignadoInput.value.trim() === '') {
    paisAsignado_guiaError.textContent = 'El guía debe tener un país asociado.';
    isValid = false;
  } else if (pais_asignadoInput.value.trim().length < 3) {
    paisAsignado_guiaError.textContent = 'El país asociado al guía debe tener al menos 3 caracteres.';
    isValid = false;
  }

  return isValid;
}
</script>

  </body>
</html>
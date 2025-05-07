<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Práctica final 1º DAW Semi lenguaje de marcas</title>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="">About us</a></li>
            <li><a href="">Destinations</a></li>
            <li><a href="">Tours</a></li>
            <li><a href="">Blog</a></li>
          </ul>
        </nav>
        <div style="clear: both"></div>
      </header>
      
      <section id="destinos_form">
        <form>
          <h3>Crea un nuevo destino</h3>
          <p>Introduce el nombre, la información y una foto del destino que quieras introducir.</p>
          <input type="email" placeholder="Enter Your email Adress" />
        </form>
        <div style="clear: both"></div>
      </section>
    </div>
    <footer>
      <img src="img/logo.png" />
      <p>Enjoy the touring</p>
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
      <p id="firma">Creado por nadie · 2020</p>
    </footer>
  </body>
</html>

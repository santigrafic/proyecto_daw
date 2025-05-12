<?php /*include 'database.php';*/ ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Práctica final 1º DAW Semi Proyecto Intermodular</title>
    <meta name="description" content="Web de agencia de viajes" />
    <meta
      name="keywords"
      content="travel, places, destinations, lovely, popular destinations, newsletter, daw"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <li><a href="">Blog</a></li>
          </ul>
        </nav>
        <a href="" id="boton_book_now">Reserva Ahora</a>
        <div style="clear: both"></div>
      </header>
      <section id="hero">
        <div id="texto_slide">
          <h1>Descubre los Lugares más Encantadores</h1>
          <p>
          Planifica y reserva tu viaje perfecto con nuestros consejos expertos, recomendaciones, información sobre destinos e inspiración para viajar.
          </p>
        </div>
        <div id="imagen_slide">
          <img
            id="icono_mapa"
            src="img/mapa.png"
            title="icono_mapa"
            alt="icono de un mapa"
          />
          <img
            id="img_slide"
            src="img/section1.png"
            title="Chico_agencia"
            alt="imagen del chico de la agencia"
          />
        </div>
        <div style="clear: both"></div>
      </section>
      <section id="destinations">
        <h2>Explora los Destinos Más Populares</h2>
        <div class="noticias_home">
          <img src="img/noticia1.jpg" />
          <h3>Mountain Hiking Tour</h3>
          <p>Mountain Hiking Tour</p>
          <a href="" id="boton_book_noticias">Reservar Ahora</a>
        </div>
        <div class="noticias_home">
          <img src="img/noticia2.jpg" />
          <h3>Machu Pichu, Perú</h3>
          <p>Machu Pichu, Perú</p>
          <a href="" id="boton_book_noticias">Reservar Ahora</a>
        </div>
        <div class="noticias_home">
          <img src="img/noticia3.jpg" />
          <h3>The Grand Canyon, Arizona</h3>
          <p>The Grand Canyon, Arizona</p>
          <a href="" id="boton_book_noticias">Reservar Ahora</a>
        </div>
        <div style="clear: both"></div>
      </section>
      <section id="newsletter">
        <form>
          <h3>Suscribete a nuestro boletín</h3>
          <p>Recibe las últimas noticias, actualizaciones y muchas otras cosas cada semana.</p>
          <input type="email" placeholder="Introduce tu dirección de correo electrónico" />
        </form>
        <div style="clear: both"></div>
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
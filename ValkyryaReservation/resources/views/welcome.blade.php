@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('node_modules/normalize.css/normalize.css') }}">
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>

  <!-- Banner Section -->
  <section class="banner">
    <video class="banner-video" autoplay muted loop>
      <source src="{{ asset('img/video-banner.mp4') }}" type="video/mp4">
    </video>
    <div class="overlay"></div>
    <div class="banner-content">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
      <h1>Alquiler de Barco en Denia</h1>
      <h2>GTP LUX | Sun & Mediterranean Sea</h2>
      <a href="#slider" class="btn">Reservar</a>
    </div>
  </section>

  <!-- Texto de bienvenida -->
  <section class="text-home">
    <div class="container">
      <!-- Columna de texto -->
      <div class="text-column">
        <h2>¡Bienvenido a GTP LUX!</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quis autem saepe rem ab incidunt maxime provident modi fuga doloribus, ducimus ut id ipsa, eum tempora! Perspiciatis dolor velit veniam?
        </p>
      </div>

      <!-- Columna de imagen -->
      <div class="image-column">
        <img src="{{ asset('img/yates.png') }}" alt="Yate elegante" class="oval-image">
      </div>
    </div>
  </section>

  <!-- Slider -->
  <section id="slider" class="slider-container">
    <!-- Título principal -->
    <h2 class="slider-title">Te ofrecemos una experiencia inolvidable</h2>

    <!-- Primera sección: Imagen derecha, texto izquierda -->
    <div class="info-row">
      <div class="slider-with-arrows">
        <button class="prev">&lt;</button>
        <div class="slider">
          <div class="slides">
            <img src="{{ asset('img/yates.png') }}" alt="Imagen 1">
            <img src="{{ asset('img/yates2.png') }}" alt="Imagen 2">
          </div>
        </div>
        <button class="next">&gt;</button>
      </div>
      <div class="info-text">
        <h3>VALKYRYA</h3>
        <p>Valkyrya es el inicio de una experiencia exclusiva en el mar. 
          Con un diseño elegante, solarium, toldo retráctil, música de alta calidad y nevera, es el yate perfecto para explorar las aguas cristalinas de la isla. 
          Su motor de 200CV garantiza una navegación suave, permitiéndote disfrutar de cada parada con lujo y confort.</p>
        <a href="{{ route('valkyrya') }}">
          <button id="reservation-btn" class="btn">VER DISPONIBILIDAD</button>
        </a>
      </div>
    </div>

    <!-- Segunda sección: Imagen izquierda, texto derecha -->
    <div class="info-row reverse">
      <div class="slider-with-arrows">
        <button class="prev">&lt;</button>
        <div class="slider">
          <div class="slides">
            <img src="{{ asset('img/yates3.png') }}" alt="Imagen 3">
            <img src="{{ asset('img/yates4.png') }}" alt="Imagen 4">
          </div>
        </div>
        <button class="next">&gt;</button>
      </div>
      <div class="info-text">
        <h3>NADINE</h3>
        <p>Nadine es el barco perfecto para una experiencia inolvidable. 
          Con dos potentes motores de 300CV, toldo retráctil, solarium, música y nevera, te ofrece el máximo confort y personalización para recorrer los rincones más exclusivos del mar. 
          Disfruta de una jornada de lujo adaptada a tus deseos.</p>
        <a href="{{ route('nadine') }}">
          <button id="reservation-btn" class="btn">VER DISPONIBILIDAD</button>
        </a>
      </div>
    </div>
  </section>

  <!-- Calendario de Reservas -->
  <section class="reservation">
    <div class="content">
      <h2>Reserva tu barco</h2>
      <div id="react-root"></div>
      <div class="calendar-container">
        <input type="date" id="reservation-date">
      </div>
      <button id="reservation-btn" class="btn" disabled>CONFIRMAR RESERVA</button>
    </div>
  </section>

  <!-- Mapa -->
  <section class="map-form">
    <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=..." width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="form-container">
      <h3>¿Tienes alguna duda?</h3>
      <form>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido">

        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono">

        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo">

        <label for="motivo">Asunto</label>
        <textarea id="motivo" name="motivo"></textarea>

        <button class="form-button">Enviar</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-left">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo">
        </a>
        <div class="social-icons">
          <a href="https://instagram.com" target="_blank">
            <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
          </a>
          <a href="https://facebook.com" target="_blank">
            <img src="{{ asset('img/facebook.png') }}" alt="Facebook">
          </a>
        </div>
        <p class="contact-email">contacto@empresa.com</p>
        <p class="location">Marina Naviera Balear, Av. de Gabriel Roca, 07013 Palma, Balearic Islands</p>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/menu-burger.js') }}"></script>
@endsection

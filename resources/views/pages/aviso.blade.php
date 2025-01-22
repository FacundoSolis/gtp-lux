@extends('layouts.public')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('title', 'Aviso Legal')

@section('content')
<header class="header">
    <!-- Menú igual que en las otras páginas -->
</header>

<div class="container mt-5">
    <h2 class="text-center">Aviso Legal</h2>
    <p class="text-center">Este documento regula las condiciones de uso del sitio web y la información legal correspondiente.</p>
    <!-- Contenido adicional aquí -->
</div>

<!-- Footer personalizado -->
<footer class="footer">
  <div class="footer-container">
    <!-- Columna 1: Logo y descripción -->
    <div class="footer-column">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="{{ __('footer') }}" class="footer-logo">
      </a>
      <div class="social-icons">
        <p>{{ __('social_media') }}</p>
        <a href="https://instagram.com" target="_blank">
          <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
        </a>
        <a href="https://facebook.com" target="_blank">
          <img src="{{ asset('img/facebook.png') }}" alt="Facebook">
        </a>
      </div>
    </div>

    <!-- Columna 2: Contacto -->
    <div class="footer-column footer-align footer-offset">
      <p>Teléfono: +34 123 456 789</p>
      <p>Correo: contacto@empresa.com</p>
      <p>Dirección: Marina de Denia, España</p>
    </div>

  <!-- Columna 3: Enlaces -->
  <div class="footer-column footer-align footer-offset">
      <ul class="footer-links">
        <li><a href="{{ route('aviso') }}">Aviso Legal</a></li>
        <li><a href="{{ route('contacto') }}">Contacto</a></li>
        <li><a href="{{ route('nosotros') }}">Nosotros</a></li>
        <li><a href="{{ route('politicas') }}">Políticas</a></li>
        <li><a href="{{ route('terminos') }}">Términos</a></li>
      </ul>
    </div>

    <!-- Columna 4: Suscripción -->
    <div class="footer-column footer-align footer-offset">
      <p>Suscríbete a nuestro boletín para recibir las últimas noticias y ofertas.</p>
      <form class="subscribe-form">
        <input type="email" placeholder="Tu email" class="subscribe-input">
        <button type="submit" class="subscribe-button">SUSCRIBE</button>
      </form>
    </div>
  </div>
</footer>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endpush

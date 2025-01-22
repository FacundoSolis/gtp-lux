@extends('layouts.public')

@php
    use Illuminate\Support\Facades\App;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('title', 'Contacto')

@section('content')
<header class="header">
    <div class="topbar__logo">
        <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <nav class="navbar">
        <!-- Menú hamburguesa -->
        <label class="label_hamburguesa" for="menu_hamburguesa">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="list_icon" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </label>
        <input class="menu_hamburguesa" type="checkbox" id="menu_hamburguesa">

        <!-- Enlaces de navegación -->
        <ul class="ul_links">
            <li class="li_links"><a href="#" class="link">{{ __('home') }}</a></li>
            <li class="li_links"><a href="#contacto" class="link">{{ __('contact') }}</a></li>
            <li class="li_links"><a href="#quienes-somos" class="link">{{ __('about_us') }}</a></li>
            <li class="li_links settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img id="currentLanguageFlag" src="{{ asset('path_to_flags/' . App::getLocale() . '.png') }}" 
                             alt="{{ config('languages')[App::getLocale()]['name'] }}" class="flag-icon">
                        {{ config('languages')[App::getLocale()]['name'] }}
                    </span>
                    <ul class="dropdown-menu" id="languageDropdown">
                        @foreach (config('languages') as $code => $language)
                            <li>
                            <a href="{{ url(App::getLocale() . '/set-locale/es') }}">Español</a>
                            <a href="{{ url(App::getLocale() . '/set-locale/en') }}">English</a>
                            <a href="{{ url(App::getLocale() . '/set-locale/fr') }}">Français</a>
                                    <img src="{{ asset('path_to_flags/' . $code . '.png') }}" 
                                         alt="{{ $language['name'] }}" class="flag-icon">
                                    {{ $language['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>

<div class="contact-header text-center">
    <h2 class="text-primary">Contáctanos</h2>
    <p>Estamos aquí para responder a tus preguntas y comentarios. ¡Déjanos un mensaje!</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" placeholder="Escribe tu nombre completo" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Escribe tu correo electrónico" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="subject" placeholder="Escribe el asunto de tu mensaje">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Escribe tu mensaje aquí" required></textarea>
                </div>
                <div class="text-center2">
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
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
      <p>Teléfono: +34 910 059 958</p>
      <p>Correo: info@gtplux.com</p>
      <p>Dirección: Marina de Denia, España</p>
    </div>

    <!-- Columna 3: Enlaces -->
    <div class="footer-column footer-align footer-offset">
      <ul class="footer-links">
        <li><a href="{{ route('aviso') }}">Aviso Legal</a></li>
        <li><a href="{{ route('terminos') }}">Términos y condiciones</a></li>
        <li><a href="{{ route('politicas') }}">Políticas de Privacidad</a></li>
        <li><a href="{{ route('politicas') }}">Políticas de Cookies</a></li>
        <li><a href="{{ route('politicas') }}">Políticas de Cancelación</a></li>
        <li><a href="{{ route('nosotros') }}">Sobre Nosotros</a></li>
        <li><a href="{{ route('contacto') }}">Contacto</a></li>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownContainer = document.querySelector('.dropdown');
        const dropdownValue = dropdownContainer.querySelector('.value');
        const languageDropdown = document.getElementById('languageDropdown');

        dropdownValue.addEventListener('click', function (event) {
            event.stopPropagation();
            const isDropdownOpen = languageDropdown.style.display === 'block';
            languageDropdown.style.display = isDropdownOpen ? 'none' : 'block';
        });

        document.addEventListener('click', function (event) {
            if (!dropdownContainer.contains(event.target)) {
                languageDropdown.style.display = 'none';
            }
        });
    });
</script>
@endpush

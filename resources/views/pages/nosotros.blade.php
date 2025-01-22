@extends('layouts.public')

@php
    use Illuminate\Support\Facades\App;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('title', 'Quiénes Somos')

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
                                <a href="{{ route('set-locale', $code) }}" class="language">
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

<div class="container mt-7">
    <h2 class="quienes text-center text-primary display-4">Quiénes Somos</h2>
    <p class="text-center fs-5 text-muted mt-4">
        Somos una empresa apasionada por el mar, dedicada a ofrecer experiencias inolvidables a nuestros clientes. Nuestro compromiso es garantizar calidad, confianza y momentos únicos en cada viaje. 
        Creemos en la importancia de brindar un servicio que supere las expectativas.
    </p>
</div>

<div class="container">
    <div class="row mt-5 align-items-center">
        <div class="col-lg-6">
            <img src="{{ asset('img/about-us.jpg') }}" alt="Sobre Nosotros" class="img-fluid rounded shadow-lg" style="max-height: 400px; object-fit: cover;">
        </div>
        <div class="col-lg-6">
            <h3 class="mt-4 text-secondary fw-bold">Nuestra Misión</h3>
            <p class="fs-5">
                Proporcionar un servicio excepcional y accesible para que todos puedan disfrutar del mar de forma segura, cómoda y placentera. Nuestro equipo trabaja incansablemente para generar 
                experiencias únicas que nuestros clientes recordarán para siempre.
            </p>
            <h3 class="mt-4 text-secondary fw-bold">Nuestra Visión</h3>
            <p class="fs-5">
                Aspiramos a convertirnos en líderes en el sector del alquiler de barcos, destacándonos por nuestra innovación, excelencia y compromiso con el medio ambiente. Queremos ser el referente 
                de confianza para quienes buscan explorar el mar con total libertad.
            </p>
        </div>
    </div>

    <div class="row mt-5">
        <h3 class="text-center text-primary fw-bold mb-4">Nuestros Valores</h3>
        <div class="col-md-4 text-center">
            <div class="card shadow-sm p-4 border-0 h-100">
                <i class="fas fa-star text-warning fa-2x mb-3"></i>
                <h5 class="fw-bold">Calidad</h5>
                <p class="text-muted">Ofrecemos un servicio de primera categoría, cuidando cada detalle para garantizar la mejor experiencia posible.</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card shadow-sm p-4 border-0 h-100">
                <i class="fas fa-handshake text-primary fa-2x mb-3"></i>
                <h5 class="fw-bold">Confianza</h5>
                <p class="text-muted">Construimos relaciones duraderas basadas en la transparencia y el compromiso con nuestros clientes.</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card shadow-sm p-4 border-0 h-100">
                <i class="fas fa-leaf text-success fa-2x mb-3"></i>
                <h5 class="fw-bold">Sostenibilidad</h5>
                <p class="text-muted">Nos preocupamos por el medio ambiente y trabajamos para reducir el impacto ambiental en todas nuestras operaciones.</p>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownContainer = document.querySelector('.dropdown');
        const dropdownValue = dropdownContainer.querySelector('.value');
        const languageDropdown = document.getElementById('languageDropdown');

        // Abrir o cerrar el menú al hacer clic en el contenedor
        dropdownValue.addEventListener('click', function (event) {
            event.stopPropagation(); // Evita el cierre inmediato
            const isDropdownOpen = languageDropdown.style.display === 'block';
            languageDropdown.style.display = isDropdownOpen ? 'none' : 'block';
        });

        // Cerrar el menú al hacer clic fuera del dropdown
        document.addEventListener('click', function (event) {
            if (!dropdownContainer.contains(event.target)) {
                languageDropdown.style.display = 'none';
            }
        });

        // Manejar selección de idioma
        languageDropdown.querySelectorAll('.language').forEach(function (item) {
            item.addEventListener('click', function (event) {
                event.preventDefault(); // Evita la navegación del enlace

                const selectedLang = this.getAttribute('href').split('/').pop(); // Extraer idioma del enlace
                fetch(`/set-locale/${selectedLang}`) // Usa el idioma seleccionado dinámicamente
                    .then(response => {
                        if (response.ok) {
                            location.reload(); // Recargar la página para aplicar el cambio
                        } else {
                            console.error('Error al cambiar el idioma.');
                        }
                    })
                    .catch(error => console.error('Error en la solicitud de cambio de idioma:', error));

                // Cerrar el menú después de seleccionar un idioma
                languageDropdown.style.display = 'none';
            });
        });
    }); // Cierre del bloque 'DOMContentLoaded'
</script>
@endpush


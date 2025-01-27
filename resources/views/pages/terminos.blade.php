@extends('layouts.public')

@php
    use Illuminate\Support\Facades\App;
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endpush

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

@section('title', __('terms_and_conditions'))

@section('content')
<div class="container mt-7">
    <h1 class="text-center text-primary display-4">{!! __('terms_and_conditions_h1_title') !!}</h1>
    <p class="text-center fs-5 text-muted mt-4">{!! __('terms_and_conditions_h1_p') !!}</p>
</div>


<div class="container">
    <div class="row mt-5">
        <!-- Sección 1 -->
        <h3 class="text-center text-primary fw-bold mb-4">{!! __('terms_and_conditions_h2_1_title') !!}</h3>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h2_1_p') !!}</p>

        <!-- Sección 2 -->
        <h3 class="text-center text-primary fw-bold mb-4">{!! __('terms_and_conditions_h2_2_title') !!}</h3>

        <h4>{!! __('terms_and_conditions_h3_1_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_1_p') !!}</p>

        <h4>{!! __('terms_and_conditions_h3_2_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_2_p') !!}</p>

        <h4>{!! __('terms_and_conditions_h3_3_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_3_p') !!}</p>

        <!-- Sección 3 -->
        <h3 class="text-center text-primary fw-bold mb-4">{!! __('terms_and_conditions_h2_3_title') !!}</h3>

        <h4>{!! __('terms_and_conditions_h3_4_title') !!}</h4>
        <ul class="text-muted fs-5">
            {!! __('terms_and_conditions_h3_4_p') !!}
        </ul>

        <h4>{!! __('terms_and_conditions_h3_5_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_5_p') !!}</p>

        <!-- Sección 4 -->
        <h3 class="text-center text-primary fw-bold mb-4">{!! __('terms_and_conditions_h2_4_p') !!}</h3>

        <h4>{!! __('terms_and_conditions_h3_6_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_6_p') !!}</p>

        <h4>{!! __('terms_and_conditions_h3_7_title') !!}</h4>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h3_7_p') !!}</p>

        <!-- Sección 5 -->
        <h3 class="text-center text-primary fw-bold mb-4">{!! __('terms_and_conditions_h2_5_title') !!}</h3>
        <p class="text-muted fs-5">{!! __('terms_and_conditions_h2_5_p') !!}</p>
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
      <p>{{ __('phone') }}: +34 910 059 958</p>
      <p>{{ __('email') }}: info@gtplux.com</p>
      <p>{{ __('location_address') }}</p>
  </div>
    <!-- Columna 3: Enlaces -->
    <div class="footer-column footer-align footer-offset">
      <ul class="footer-links">
        <li><a href="{{ route('aviso') }}">{!! __('legal_notice') !!}</a></li>
        <li><a href="{{ route('terminos') }}">{!! __('terms_and_conditions') !!}</a></li>
        <li><a href="{{ route('politicas') }}">{!! __('privacy_policy') !!}</a></li>
        <li><a href="{{ route('politicas') }}">{!! __('cancellation_policy') !!}</a></li>
        <li><a href="{{ route('nosotros') }}">{!! __('about_us_title') !!}</a></li>
        <li><a href="{{ route('contacto') }}">{!! __('contact') !!}</a></li>
      </ul>
    </div>

    <!-- Columna 4: Suscripción -->
    <div class="footer-column footer-align footer-offset">
      <p>Suscríbete a nuestro boletín para recibir las últimas noticias y ofertas.</p>
      <form class="subscribe-form">
      <input type="email" placeholder="{{ __('email') }}" class="subscribe-input">
      <button type="submit" class="subscribe-button">SUSCRIBE</button>
      </form>
    </div>
  </div>
</footer>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
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
});
</script>


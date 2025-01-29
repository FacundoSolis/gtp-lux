@extends('layouts.public')
@section('title', $meta_title ?? 'Confirmación de Reserva - GtpLux')
@section('meta_description', $meta_description ?? '¡Tu reserva ha sido confirmada! Disfruta de una experiencia inolvidable navegando en nuestros barcos de lujo en Denia.')
@section('meta_keywords', $meta_keywords ?? 'reserva confirmada, alquiler de barcos, Denia, GtpLux, experiencia de navegación, Mediterráneo')
@php
    use Illuminate\Support\Facades\App;
@endphp
@push('styles')
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endpush
@section('title', 'Confirmación de Reserva')

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
          <li class="li_links"><a href="{{ url('/') }}" class="link">{{ __('home') }}</a></li>
          <li class="li_links"><a href="{{ url('pages/contacto') }}" class="link">{{ __('contact') }}</a></li>
            <li class="li_links"><a href="{{ url('pages/nosotros') }}" class="link">{{ __('about_us') }}</a></li>
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

@include('partials.progress-bar', ['step' => 4])

<div class="container mt-5">
    <!-- Mensaje de Éxito -->
    <div class="text-center">
        <i class="bi bi-check-circle text-white" style="font-size: 4rem;"></i>
        <h1 class="text-white mt-3">{{ __('reservation_confirmed') }}</h1>
        <p class="lead mt-3">{{ __('thank_you') }}</p>
    </div>

    <!-- Detalles de la Reserva -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">{{ __('reservation_details') }}</h3>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>{{ __('port') }}:</strong> {{ $reservation->port->name }}</li>
                        <li class="list-group-item"><strong>{{ __('boat') }}:</strong> {{ $reservation->boat->name }}</li>
                        <li class="list-group-item"><strong>{{ __('pickup_date') }}:</strong> {{ $reservation->pickup_date }}</li>
                        <li class="list-group-item"><strong>{{ __('drop_off_date') }}:</strong> {{ $reservation->return_date }}</li>
                        <li class="list-group-item"><strong>{{ __('name') }}:</strong> {{ $reservation->name }}</li>
                        <li class="list-group-item"><strong>{{ __('surname') }}:</strong> {{ $reservation->surname }}</li>
                        <li class="list-group-item"><strong>{{ __('email') }}:</strong> {{ $reservation->email }}</li>
                        <li class="list-group-item"><strong>{{ __('phone') }}:</strong> {{ $reservation->phone }}</li>
                        <li class="list-group-item"><strong>{{ __('price_total_summary') }}:</strong> €{{ number_format($reservation->total_price, 2) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de Despedida -->
    <div class="text-center mt-5">
        <p class="fs-5">{{ __('enjoy_experience') }}</p>
        <a href="{{ route('welcome') }}" class="btn btn-success btn-lg mt-3">
            <i class="bi bi-house-door-fill me-2"></i> {{ __('home') }}
        </a>
    </div>
</div>

<!-- Footer personalizado -->
<footer class="footer">
  <div class="footer-container">
    <!-- Columna 1: Logo y Redes Sociales -->
    <div class="footer-column">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="{{ __('footer') }}" class="footer-logo">
      </a>
      <div class="social-icons">
        <p>{{ __('social_media') }}</p>
        <!-- Nuevos íconos sociales -->
        <div class="content-center">
          <ul>
            <li>
              <a href="https://www.facebook.com/" target="_blank">
                <i class="fa fa-facebook fa-2x"></i>
              </a>
            </li>
            <li>
              <a href="https://instagram.com/" target="_blank">
                <i class="fa fa-instagram fa-2x"></i>
              </a>
            </li>
          </ul>
        </div>
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
      <li><a href="{{ route('pages.show', 'aviso') }}">{!! __('legal_notice') !!}</a></li>
        <li><a href="{{ route('pages.show', 'terminos') }}">{!! __('terms_and_conditions') !!}</a></li>
        <li><a href="{{ route('pages.show', 'politicas') }}">{!! __('privacy_policy') !!}</a></li>
        <li><a href="{{ route('pages.show', 'cancelacion') }}">{!! __('cancellation_policy') !!}</a></li>
        <li><a href="{{ route('pages.show', 'nosotros') }}">{!! __('about_us') !!}</a></li>
        <li><a href="{{ route('pages.show', 'contacto') }}">{!! __('contact') !!}</a></li>
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

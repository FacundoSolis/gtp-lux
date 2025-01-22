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

@section('title', 'Términos y Condiciones')

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
    <h1 class="text-center text-primary display-4">Términos y Condiciones de GTP Lux</h1>
    <p class="text-center fs-5 text-muted mt-4">
        Bienvenido a GTP Lux. Al utilizar nuestros servicios, aceptas los siguientes términos y condiciones. Te recomendamos leerlos detenidamente antes de realizar cualquier reserva.
    </p>
</div>

<div class="container">
    <div class="row mt-5">
        <h3 class="text-center text-primary fw-bold mb-4">1. Información General</h3>
        <p class="text-muted fs-5">
            GTP Lux, con razón social GTP Lux S.L., se especializa en el alquiler de barcos para clientes internacionales. Nuestros servicios están sujetos a las leyes vigentes en España. Todas las reservas y el uso de nuestros bienes se rigen por los presentes términos.
        </p>

        <h3 class="text-center text-primary fw-bold mb-4">2. Reservas y Pagos</h3>
        <h4>2.1 Métodos de Pago</h4>
        <p class="text-muted fs-5">Aceptamos pagos mediante tarjeta de crédito/débito y PayPal. Todos los pagos se procesan de manera segura a través de plataformas certificadas.</p>

        <h4>2.2 Precios y Cargos Adicionales</h4>
        <p class="text-muted fs-5">Los precios publicados incluyen el alquiler del barco. Sin embargo, el servicio de tripulación tiene un coste adicional, que deberá contratarse directamente con nosotros.</p>

        <h4>2.3 Política de Cancelación</h4>
        <p class="text-muted fs-5">La cancelación de reservas está sujeta a nuestra política de cancelación, la cual puedes consultar aquí.</p>

        <h3 class="text-center text-primary fw-bold mb-4">3. Uso de los Bienes</h3>
        <h4>3.1 Condiciones de Uso</h4>
        <ul class="text-muted fs-5">
            <li>Los barcos alquilados deben ser utilizados exclusivamente para fines recreativos.</li>
            <li>Queda prohibido fumar a bordo, salvo en las áreas designadas.</li>
            <li>No se permite el acceso a mascotas sin autorización previa.</li>
        </ul>

        <h4>3.2 Responsabilidad del Cliente</h4>
        <p class="text-muted fs-5">El cliente es responsable de cualquier daño causado al barco durante el periodo de alquiler. Se recomienda revisar el estado del barco al inicio del alquiler y reportar cualquier anomalía.</p>

        <h3 class="text-center text-primary fw-bold mb-4">4. Reclamaciones y Resolución de Conflictos</h3>
        <h4>4.1 Procedimiento de Reclamaciones</h4>
        <p class="text-muted fs-5">Cualquier reclamación debe ser enviada por escrito al correo electrónico support@gtplux.com en un plazo máximo de 15 días tras la finalización del alquiler.</p>

        <h4>4.2 Ley Aplicable y Jurisdicción</h4>
        <p class="text-muted fs-5">Estos términos se rigen por la legislación española. Cualquier conflicto que surja entre las partes será resuelto en los juzgados de Madrid, salvo disposición legal en contrario.</p>

        <h3 class="text-center text-primary fw-bold mb-4">5. Modificaciones de los Términos</h3>
        <p class="text-muted fs-5">GTP Lux se reserva el derecho de modificar estos términos en cualquier momento. Cualquier cambio será notificado en nuestra página web y entrará en vigor a partir de su publicación.</p>
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
@endpush

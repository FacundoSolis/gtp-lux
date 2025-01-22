@extends('layouts.public')
@php
    use Illuminate\Support\Facades\App;
@endphp
@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@section('title', 'Método de Pago')

@section('content')

@php
    $boatImage = '';

    if (strpos($reservation->boat->name, 'Portofino') !== false) {
        $boatImage = asset('img/protofino/Portofino.png'); // Ruta actualizada
    } elseif (strpos($reservation->boat->name, 'Princess') !== false) {
        $boatImage = asset('img/princess/princess.jpg'); // Ruta actualizada
    }
@endphp

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

<div>
    <h2>{{ __('reservation_info') }}</h2>
</div>
@include('partials.progress-bar', ['step' => 3])

<div class="container mt-5">
    <div class="row">
        <!-- Sección de Información de la Reserva -->
        <section class="reservation-info col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h4>{{ __('reservation_details') }}</h4>
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>{{ __('name') }}</strong> {{ $reservation->name }}</li>
                            <li class="list-group-item"><strong>{{ __('surname') }}:</strong> {{ $reservation->surname }}</li>
                            <li class="list-group-item"><strong>{{ __('email') }}</strong> {{ $reservation->email }}</li>
                            <li class="list-group-item"><strong>{{ __('phone') }}</strong> {{ $reservation->phone }}</li>
                            <li class="list-group-item"><strong>{{ __('port') }}</strong> {{ __('marina_de_denia') }}</li>
                            <li class="list-group-item"><strong>{{ __('pickup_date') }}</strong> {{ $reservation->pickup_date }}</li>
                            <li class="list-group-item"><strong>{{ __('drop_off_date') }}</strong> {{ $reservation->return_date }}</li>
                            <li class="list-group-item"><strong>{{ __('boat') }}</strong> {{ $reservation->boat->name }}</li>
                            <li class="list-group-item"><strong>{{ __('Precio total') }}</strong> €{{ number_format($reservation->total_price, 2) }}</li>
                        </ul>
                        <li class="list-group-item">
                            <img src="{{ $boatImage }}" alt="Imagen de {{ $reservation->boat->name }}" class="img-fluid rounded">
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Sección de Métodos de Pago -->
        <section class="payment-methods col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>{{ __('select_payment_method') }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <!-- Pago con Stripe -->
                        <form action="{{ route('stripe.process', ['reservation' => $reservation->id]) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="bi bi-stripe me-2"></i> {{ __('pay_with_card') }}
                            </button>
                        </form>
                        </form>
                        <!-- Pago con PayPal -->
                        <a href="{{ route('paypal.create', $reservation->id) }}" class="btn btn-warning btn-lg">
                            <i class="bi bi-paypal me-2"></i> {{ __('pay_with_paypal') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
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




@extends('layouts.public')
@section('title', $meta_title ?? 'Completa tu reserva - GtpLux')
@section('meta_description', $meta_description ?? 'Finaliza tu experiencia de alquiler de barcos con GtpLux. Ingresa tus datos y asegura tu viaje de lujo en el Mediterráneo.')
@section('meta_keywords', $meta_keywords ?? 'alquiler de barcos, reserva, yates, Denia, GtpLux, lujo, Mediterráneo')
@php

    use Illuminate\Support\Facades\App;
    // Obtener datos de la URL
    $boatId = request()->query('boat_id');
    $portId = request()->query('port_id');
    $pickupDate = request()->query('pickup_date');
    $returnDate = request()->query('return_date');
    $price = request()->query('price', 0);

    // Definir imágenes basadas en el ID del barco
    $boatImages = [
        3 => asset('img/protofino/Portofino.png'),
        4 => asset('img/princess/princes7.jpg'),
    ];

    $boatNames = [
        3 => 'Sunseeker Portofino',
        4 => 'Princess',
    ];

    $boatImage = $boatImages[$boatId] ?? asset('img/default-boat.png'); // Imagen predeterminada si no coincide
    $boatName = $boatNames[$boatId] ?? 'Barco Desconocido';
@endphp
@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@endpush
@section('content')
@include('partials.progress-bar', ['step' => 2])

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

<div class="container mt-5">
    <div class="page-title-container text-center">
        <h1 class="page-title">{{ __('reservation_form') }}</h1>
        <p class="page-subtitle">Proporciónanos tus datos para finalizar tu experiencia de navegación.</p>
    </div>

    <div class="row">
        <!-- Columna de la izquierda -->
        <div class="col-md-6">
            <!-- Tarjeta de información de la reserva -->
            <div class="reservation-summary bg-light p-3 rounded mb-4 shadow-sm">
                <h3 class="text-center">{{ __('reservation_details') }}</h3>
                <ul class="list-unstyled">
                    <li><strong>{{ __('port') }}</strong> Marina de Denia</li>
                    <li><strong>{{ __('pickup_date') }}</strong> {{ $pickupDate }}</li>
                    <li><strong>{{ __('drop_off_date') }}</strong> {{ $returnDate }}</li>
                    <li><strong>{{ __('boat') }}</strong> {{ $boatName }}</li>
                    <li><strong>{{ __('price_total_summary') }}</strong> €{{ number_format($price, 2) }}</li>
                </ul>
            </div>

            <!-- Tarjeta del formulario -->
            <div class="bg-white p-4 rounded shadow-sm">
                <h4 class="mb-3">{!! __('contact') !!}</h4>
                <form action="{{ route('reservation.saveDetails') }}" method="POST">
                    @csrf
                    <input type="hidden" name="port_id" value="{{ $reservation['port_id'] }}">
                    <input type="hidden" name="pickup_date" value="{{ $reservation['pickup_date'] }}">
                    <input type="hidden" name="return_date" value="{{ $reservation['return_date'] }}">
                    <input type="hidden" name="boat_id" value="{{ $reservation['boat_id'] }}">
                    <input type="hidden" id="hidden-price" name="price" value="{{ $reservation['price'] }}">
                    <!-- Campos visibles -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('name') }}:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="surname" class="form-label">{{ __('surname') }}:</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('email') }}:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email_confirm" class="form-label">{{ __('email') }}:</label>
                            <input type="email" class="form-control" id="email_confirm" name="email_confirm" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="phone" class="form-label">{{ __('phone') }}:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('proceed_to_payment') }}:</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columna de la derecha -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="{{ $boatImage }}" alt="{{ $boatName }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $boatName }}</h5>
                </div>
            </div>
        </div>
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

    // Manejo del menú desplegable
    dropdownValue.addEventListener('click', function (event) {
        event.stopPropagation();
        languageDropdown.style.display = languageDropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (event) {
        if (!dropdownContainer.contains(event.target)) {
            languageDropdown.style.display = 'none';
        }
    });

    languageDropdown.querySelectorAll('.language').forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const selectedLang = this.getAttribute('href').split('/').pop();
            fetch(`/set-locale/${selectedLang}`)
                .then(response => {
                    if (response.ok) location.reload();
                })
                .catch(error => console.error('Error al cambiar idioma:', error));
        });
    });
});
</script>

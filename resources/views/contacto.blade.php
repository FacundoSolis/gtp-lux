@extends('layouts.public')
@php
    use Illuminate\Support\Facades\App;
@endphp
@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endpush
@section('content')
@include('partials.progress-bar', ['step' => 2])
<header class="header">
    <div class="topbar__logo">
        <a href="http://127.0.0.1:8000">
            <img src="http://127.0.0.1:8000/img/logo.png" alt="Logo" class="logo">
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
<div class="container mt-5">
    <h3>Datos de Contacto</h3>
    <form action="{{ route('payment', ['reservation' => $reservation->id]) }}" method="POST">
    @csrf
        @csrf
        <!-- Campos ocultos para enviar los datos seleccionados -->
        <input type="hidden" name="port_id" value="{{ $reservation['port_id'] }}">
        <input type="hidden" name="pickup_date" value="{{ $reservation['pickup_date'] }}">
        <input type="hidden" name="return_date" value="{{ $reservation['return_date'] }}">
        <input type="hidden" name="boat_id" value="{{ $reservation['boat_id'] }}">
        <!-- Datos seleccionados del paso anterior -->
        <div class="mb-3">
            <label for="port" class="form-label">Puerto Seleccionado</label>
            <input type="text" class="form-control" value="{{ $reservation['port_name'] }}" readonly>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="pickup_date" class="form-label">Fecha de Recogida</label>
                <input type="text" class="form-control" value="{{ $reservation['pickup_date'] }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="return_date" class="form-label">Fecha de Entrega</label>
                <input type="text" class="form-control" value="{{ $reservation['return_date'] }}" readonly>
            </div>
        </div>
        <!-- Campos de contacto -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="email_confirm" class="form-label">Confirmar Correo Electrónico</label>
            <input type="email" class="form-control" id="email_confirm" name="email_confirm" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Ir al Pago</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
@endpush
@extends('layouts.public')
@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/menu-BnIop0I-.css') }}">
<link rel="stylesheet" href="{{ asset('build/assets/confirmation-DZ7PxvDb.css') }}">
@endpush
@section('title', 'Confirmación de Reserva')

@section('content')
<header class="topbar">
    <div class="topbar__logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <nav class="nav-menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <div class="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="mobile-menu">
        <span class="close-menu">✕</span>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>

<div class="container mt-5">
    <!-- Mensaje de Éxito -->
    <div class="text-center">
        <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
        <h1 class="text-success mt-3">¡Reserva Confirmada!</h1>
        <p class="lead mt-3">Gracias por confiar en nosotros. A continuación, los detalles de tu reserva:</p>
    </div>

    <!-- Detalles de la Reserva -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Detalles de la Reserva</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Puerto:</strong> {{ $reservation->port->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Barco:</strong> {{ $reservation->boat->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Fecha de Recogida:</strong> {{ $reservation->pickup_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Fecha de Entrega:</strong> {{ $reservation->return_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Nombre:</strong> {{ $reservation->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Correo Electrónico:</strong> {{ $reservation->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Teléfono:</strong> {{ $reservation->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de Despedida -->
    <div class="text-center mt-5">
        <p class="fs-5">¡Esperamos que disfrutes tu experiencia a bordo del barco!</p>
        <a href="{{ route('welcome') }}" class="btn btn-success btn-lg mt-3">
            <i class="bi bi-house-door-fill me-2"></i> Volver al Inicio
        </a>
    </div>
</div>
@section('scripts')
<script src="{{ asset('build/assets/menu-Cd3QX7BG.js') }}"></script>
@endsection

@extends('layouts.public')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
@endpush
@section('title', 'Confirmación de Reserva')

@section('content')
<header class="header">
    <div class="topbar__logo">
        <a href="{{ route('welcome') }}">
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
            <li class="li_links"><a href="#" class="link">Inicio</a></li>
            <li class="li_links"><a href="#contacto" class="link">Contacto</a></li>
            <li class="li_links"><a href="#quienes-somos" class="link">Quiénes somos</a></li>
            <li class="li_links settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="language"><img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français</a></li>
                        <li><a href="#" class="language"><img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English</a></li>
                        <li><a href="#" class="language"><img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano</a></li>
                        <li><a href="#" class="language"><img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch</a></li>
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
                            <strong>Apellidos:</strong> {{ $reservation->surname }}
                        </li>
                        <li class="list-group-item">
                            <strong>Correo Electrónico:</strong> {{ $reservation->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Teléfono:</strong> {{ $reservation->phone }}
                        </li>
                        <li class="list-group-item">
                            <strong>Total a Pagar:</strong> €{{ number_format($reservation->total_price, 2) }}
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
@endsection

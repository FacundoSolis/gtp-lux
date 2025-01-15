@extends('layouts.public')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endpush

@section('title', 'Método de Pago')

@section('content')

@php
    $boatImage = '';

    if (strpos($reservation->boat->name, 'Portofino') !== false) {
        $boatImage = asset('img/boat/portofino.jpg'); // Ruta de la imagen de Portofino
    } elseif (strpos($reservation->boat->name, 'Princess') !== false) {
        $boatImage = asset('img/boat/princess.jpg'); // Ruta de la imagen de Princess
    }
@endphp

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
                    <ul class="dropdown-menu" id="languageDropdown">
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
<div>
    <h2>Información de reserva</h2>
</div>
@include('partials.progress-bar', ['step' => 3])

<div class="container mt-5">
    <div class="row">
        <!-- Sección de Información de la Reserva -->
        <section class="reservation-info col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h4>Detalles de la Reserva</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $reservation->name }}</li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $reservation->email }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $reservation->phone }}</li>
                        <li class="list-group-item"><strong>Puerto:</strong> {{ $reservation->port->name }}</li>
                        <li class="list-group-item"><strong>Fecha de Recogida:</strong> {{ $reservation->pickup_date }}</li>
                        <li class="list-group-item"><strong>Fecha de Entrega:</strong> {{ $reservation->return_date }}</li>
                        <li class="list-group-item"><strong>Barco:</strong> {{ $reservation->boat->name }}</li>
                        <li class="list-group-item"><strong>Total a Pagar:</strong> €{{ number_format($reservation->total_price, 2) }}</li>
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
                    <h4>Elige un Método de Pago</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <!-- Pago con Stripe -->
                        <form action="{{ route('stripe.process', ['reservation' => $reservation->id]) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-lg d-flex align-items-center justify-content-center">
                                <i class="bi bi-stripe me-2"></i> Tarjeta
                            </button>
                        </form>
                        <!-- Pago con PayPal -->
                        <a href="{{ route('paypal.create', $reservation->id) }}" class="btn btn-warning btn-lg d-flex align-items-center justify-content-center">
                            <i class="bi bi-paypal me-2"></i> PayPal
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


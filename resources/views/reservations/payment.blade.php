@extends('layouts.public')
@push('styles')
    @vite('resources/css/menu.css')
    @vite('resources/css/payment.css')
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
<div>
    <h2>Información de reserva</h2>
</div>
<div class="container mt-5">
    <div class="row">
        <!-- Columna Izquierda -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">Información de Contacto</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservation.details') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">País</label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="" disabled selected>Selecciona tu país</option>
                                <option value="España">España</option>
                                <option value="Francia">Francia</option>
                                <option value="EE.UU.">EE.UU.</option>
                            </select>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Sí, acepto los términos y condiciones de compra.
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Métodos de Pago -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Selecciona un Método de Pago</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-around mb-4">
                        <button class="btn btn-primary btn-lg" id="payCardButton">
                            <i class="bi bi-credit-card me-2"></i> Pagar con Tarjeta
                        </button>

                        <!-- Pago con Stripe -->
                        <form action="{{ route('stripe.process', ['reservation' => $reservation->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                                <i class="bi bi-stripe me-2"></i> Pagar con Stripe
                            </button>
                        </form>

                        <!-- Pago con PayPal -->
                        <a href="{{ route('paypal.create', $reservation->id) }}" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <i class="bi bi-paypal me-2"></i> Pagar con PayPal
                        </a>
                    </div>

                    <!-- Campos de Tarjeta -->
                    <div id="cardPaymentForm" style="display: none;">
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="0000 0000 0000 0000" required>
                        </div>
                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">Fecha de Expiración</label>
                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/AA" required>
                        </div>
                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Pagar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Derecha -->
        <div class="col-md-6">
            <!-- Detalles de la Reserva -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title mb-0">Detalles de la Reserva</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Barco:</strong> {{ $reservation->boat->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Puerto:</strong> {{ $reservation->port->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Fechas:</strong> {{ $reservation->pickup_date }} - {{ $reservation->return_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Precio Total:</strong> €{{ number_format($reservation->total_price, 2) }}
                        </li>
                        <li class="list-group-item">
                            <img src="{{ $boatImage }}" alt="Imagen de {{ $reservation->boat->name }}" class="img-fluid rounded">
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sección de Dudas -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title mb-0">¿Tienes dudas?</h3>
                </div>
                <div class="card-body">
                    Nuestro equipo está aquí para ayudarte en lo que necesites.
                    <br>
                    Envíanos un correo electrónico a: 
                    <a href="mailto:hola@gtplux.com">hola@gtplux.com</a>.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('payCardButton').addEventListener('click', function () {
        const cardForm = document.getElementById('cardPaymentForm');
        cardForm.style.display = cardForm.style.display === 'none' ? 'block' : 'none';
    });
</script>
@endsection

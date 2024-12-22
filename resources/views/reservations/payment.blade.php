@extends('layouts.public')

@section('title', 'Método de Pago')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pagar Reserva</h1>
    
    <!-- Resumen de Reserva -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Detalles de la Reserva</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Nombre:</strong> {{ $reservation->name }}
                        </li>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Métodos de Pago -->
    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Selecciona un Método de Pago</h2>
            <div class="d-flex justify-content-around">
                <!-- Pago con Stripe -->
                <form action="{{ route('stripe.process', ['reservation' => $reservation->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                        <i class="bi bi-credit-card me-2"></i> Pagar con Stripe
                    </button>
                </form>

                <!-- Pago con PayPal -->
                <a href="{{ route('paypal.create', $reservation->id) }}" class="btn btn-secondary btn-lg d-flex align-items-center">
                    <i class="bi bi-paypal me-2"></i> Pagar con PayPal
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

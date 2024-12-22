@extends('layouts.public')

@section('title', 'Confirmación de Reserva')

@section('content')
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
@endsection

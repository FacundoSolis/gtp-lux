@extends('layouts.public')

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/assets/confirmation-DZ7PxvDb.css') }}">
@endpush
@section('title', 'Confirmación de Reserva')

@section('content')

<div class="container mt-4">
    <h1 class="text-success">¡Reserva Confirmada!</h1>
    <p>Gracias por tu reserva. Los detalles de tu reserva son los siguientes:</p>

    <div class="card mt-4">
        <div class="card-body">
            <h3 class="card-title">Detalles de la Reserva:</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Puerto:</strong> {{ $reservation->port->name }}</li>
                <li class="list-group-item"><strong>Barco:</strong> {{ $reservation->boat->name }}</li>
                <li class="list-group-item"><strong>Fecha de Recogida:</strong> {{ $reservation->pickup_date }}</li>
                <li class="list-group-item"><strong>Fecha de Entrega:</strong> {{ $reservation->return_date }}</li>
                <li class="list-group-item"><strong>Nombre:</strong> {{ $reservation->name }}</li>
                <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $reservation->email }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $reservation->phone }}</li>
                <li class="list-group-item"><strong>Precio Total:</strong> {{ $reservation->total_price }} €</li>
            </ul>
        </div>
    </div>

    <p class="mt-4">¡Esperamos que disfrutes tu experiencia a bordo del barco!</p>
</div>
@endsection

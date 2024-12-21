<!-- resources/views/reservations/payment.blade.php -->
@extends('layouts.public')

@section('content')
<div class="container">
    <h1>Pagar Reserva</h1>
    <p><strong>Nombre:</strong> {{ $reservation->name }}</p>
    <p><strong>Barco:</strong> {{ $reservation->boat->name }}</p>
    <p><strong>Puerto:</strong> {{ $reservation->port->name }}</p>
    <p><strong>Fechas:</strong> {{ $reservation->pickup_date }} - {{ $reservation->return_date }}</p>
    <p><strong>Precio Total:</strong> ${{ $reservation->total_price }}</p>
    
    <form action="{{ route('processPayment', ['reservationId' => $reservation->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Ir a Stripe</button>
    </form>
</div>
@endsection
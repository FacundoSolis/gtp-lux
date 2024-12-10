<!-- resources/views/reservations/payment.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pagar Reserva</h1>
    <p><strong>Nombre:</strong> {{ $reservation->name }}</p>
    <p><strong>Barco:</strong> {{ $reservation->boat->name }}</p>
    <p><strong>Puerto:</strong> {{ $reservation->port->name }}</p>
    <p><strong>Fechas:</strong> {{ $reservation->pickup_date }} - {{ $reservation->return_date }}</p>
    <p><strong>Precio Total:</strong> ${{ $reservation->total_price }}</p>
    
    <form action="{{ route('confirmation', ['reservation' => $reservation->id]) }}" method="GET">
        <button type="submit" class="btn btn-success">Confirmar Pago</button>
    </form>
</div>
@endsection

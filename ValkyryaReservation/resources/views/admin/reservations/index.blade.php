@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrar Reservas</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary mb-3">Nueva Reserva</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Barco</th>
                <th>Puerto</th>
                <th>Fechas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->boat->name }}</td>
                    <td>{{ $reservation->port->name }}</td>
                    <td>{{ $reservation->pickup_date }} - {{ $reservation->return_date }}</td>
                    <td>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

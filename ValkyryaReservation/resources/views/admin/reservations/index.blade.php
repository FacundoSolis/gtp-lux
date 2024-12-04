@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservas</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Barco</th>
                <th>Puerto</th>
                <th>Fechas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->boat->name }}</td>
                    <td>{{ $reservation->port->name }}</td>
                    <td>{{ $reservation->pickup_date }} - {{ $reservation->return_date }}</td>
                    <td>
                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

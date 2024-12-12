@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Reserva</h1>
    
    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $reservation->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $reservation->email }}" required>
        </div>
        
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ $reservation->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-control" required>
                <option value="">Seleccione un puerto</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}" {{ $reservation->port_id == $port->id ? 'selected' : '' }}>{{ $port->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="boat_id" class="form-label">Barco:</label>
            <select id="boat_id" name="boat_id" class="form-control" required>
                <option value="">Seleccione un barco</option>
                @foreach($boats as $boat)
                    <option value="{{ $boat->id }}" {{ $reservation->boat_id == $boat->id ? 'selected' : '' }}>{{ $boat->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
            <input type="date" id="pickup_date" name="pickup_date" class="form-control" value="{{ $reservation->pickup_date }}" required>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Fecha de Entrega:</label>
            <input type="date" id="return_date" name="return_date" class="form-control" value="{{ $reservation->return_date }}" required>
        </div>

        <!-- Contenedor para los botones -->
        <div class="button-group">
            <button type="submit" class="btn btn-success">Actualizar Reserva</button>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </form>
</div>
@endsection

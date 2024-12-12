@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Nueva Reserva</h1>

    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-control" required>
                <option value="">Seleccione un puerto</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}">{{ $port->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="boat_id" class="form-label">Barco:</label>
            <select id="boat_id" name="boat_id" class="form-control" required>
                <option value="">Seleccione un barco</option>
                @foreach($boats as $boat)
                    <option value="{{ $boat->id }}">{{ $boat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
            <input type="date" id="pickup_date" name="pickup_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Fecha de Entrega:</label>
            <input type="date" id="return_date" name="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection

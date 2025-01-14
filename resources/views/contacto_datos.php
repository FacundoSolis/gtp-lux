@extends('layouts.public')

@section('content')
@include('partials.progress-bar', ['step' => 2])

<div class="container mt-5">
    <h3>Datos de Contacto</h3>
    <form action="{{ route('saveDetails') }}" method="POST">
        @csrf
        <!-- Datos seleccionados del paso anterior -->
        <div class="mb-3">
            <label for="port" class="form-label">Puerto Seleccionado</label>
            <input type="text" class="form-control" value="{{ $reservation['port_name'] }}" readonly>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="pickup_date" class="form-label">Fecha de Recogida</label>
                <input type="text" class="form-control" value="{{ $reservation['pickup_date'] }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="return_date" class="form-label">Fecha de Entrega</label>
                <input type="text" class="form-control" value="{{ $reservation['return_date'] }}" readonly>
            </div>
        </div>
        <!-- Campos de contacto -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="email_confirm" class="form-label">Confirmar Correo Electrónico</label>
            <input type="email" class="form-control" id="email_confirm" name="email_confirm" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Ir al Pago</button>
    </form>
</div>
@endsection

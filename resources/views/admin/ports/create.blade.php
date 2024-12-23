@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ isset($port) ? 'Editar Puerto' : 'Agregar Puerto' }}</h1>
    <form action="{{ isset($port) ? route('ports.update', $port->id) : route('ports.store') }}" method="POST">
        @csrf
        @if(isset($port))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $port->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Ubicación:</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $port->location ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($port) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>
@endsection

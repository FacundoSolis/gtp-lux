@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Puerto</h1>
    <form action="{{ route('ports.update', $port->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $port->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Ubicación:</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $port->location) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Puerto</button>
        <a href="{{ route('ports.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Barco</h1>
    <form action="{{ route('boats.update', $boat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $boat->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-control" required>
                @foreach ($ports as $port)
                    <option value="{{ $port->id }}" {{ $boat->port_id == $port->id ? 'selected' : '' }}>
                        {{ $port->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Barco</button>
        <a href="{{ route('boats.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

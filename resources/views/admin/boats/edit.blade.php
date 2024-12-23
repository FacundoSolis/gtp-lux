@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ isset($boat) ? 'Editar Barco' : 'Agregar Barco' }}</h1>
    <form action="{{ isset($boat) ? route('boats.update', $boat->id) : route('boats.store') }}" method="POST">
        @csrf
        @if(isset($boat))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $boat->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-select" required>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}" {{ (isset($boat) && $boat->port_id == $port->id) ? 'selected' : '' }}>{{ $port->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($boat) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gestión de Puertos</h5>
            <a href="{{ route('ports.create') }}" class="btn btn-light btn-sm">Agregar Puerto</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ports as $port)
                        <tr>
                            <td>{{ $port->id }}</td>
                            <td>{{ $port->name }}</td>
                            <td>{{ $port->location }}</td>
                            <td>
                                <a href="{{ route('ports.edit', $port->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('ports.destroy', $port->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este puerto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
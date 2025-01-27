@extends('layouts.admin')

@section('content')
<div class="container2">
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gestión de Barcos</h5>
            <a href="{{ route('boats.create') }}" class="btn btn-light btn-sm">Agregar Barco</a>
        </div>
        <div class="card-body2">
            <table class="table2 table-hover">
                <thead class="table-info">

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Puerto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boats as $boat)
                        <tr>
                            <td>{{ $boat->id }}</td>
                            <td>{{ $boat->name }}</td>
                            <td>{{ $boat->port->name }}</td>
                            <td>
                                <a href="{{ route('boats.edit', $boat->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('boats.destroy', $boat->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este barco?')">Eliminar</button>
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
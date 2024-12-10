@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrar Reservas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filtro y Ordenación -->
    <form action="{{ route('admin.reservations.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col">
                <select name="sort_by" class="form-control">
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nombre</option>
                    <option value="boat_id" {{ request('sort_by') == 'boat_id' ? 'selected' : '' }}>Barco</option>
                    <option value="port_id" {{ request('sort_by') == 'port_id' ? 'selected' : '' }}>Puerto</option>
                    <option value="pickup_date" {{ request('sort_by') == 'pickup_date' ? 'selected' : '' }}>Fecha Recogida</option>
                    <option value="return_date" {{ request('sort_by') == 'return_date' ? 'selected' : '' }}>Fecha Entrega</option>
                </select>
            </div>
            <div class="col">
                <select name="sort_direction" class="form-control">
                    <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Ordenar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de reservas -->
    <form action="{{ route('admin.reservations.destroyMultiple') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Nombre</th>
                <th>Barco</th>
                <th>Puerto</th>
                <th>Fecha de Recogida</th>
                <th>Fecha de Entrega</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $reservation->id }}"></td>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->boat->name }}</td>
                    <td>{{ $reservation->port->name }}</td>
                    <td>{{ $reservation->pickup_date }}</td>
                    <td>{{ $reservation->return_date }}</td>
                    <td>{{ $reservation->total_price }} $</td> <!-- Aquí se muestra el precio total -->
                    <td>
                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('admin.reservations.destroy', $reservation->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-danger">Eliminar Seleccionadas</button>
    </form>
</div>

<script>
    
    // Seleccionar/deseleccionar todas las casillas de verificación
    document.getElementById('select-all').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select-all').checked;
        });
    });
</script>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Administrar Reservas</h1>

    <!-- Mensajes de éxito/error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtro y Ordenación -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-filter"></i> Filtro y Ordenación
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reservations.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select name="sort_by" class="form-select">
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nombre</option>
                            <option value="boat_id" {{ request('sort_by') == 'boat_id' ? 'selected' : '' }}>Barco</option>
                            <option value="port_id" {{ request('sort_by') == 'port_id' ? 'selected' : '' }}>Puerto</option>
                            <option value="pickup_date" {{ request('sort_by') == 'pickup_date' ? 'selected' : '' }}>Fecha Recogida</option>
                            <option value="return_date" {{ request('sort_by') == 'return_date' ? 'selected' : '' }}>Fecha Entrega</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="sort_direction" class="form-select">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descendente</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Ordenar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de reservas -->
    <form action="{{ route('admin.reservations.destroyMultiple') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Nombre</th>
                        <th>Barco</th>
                        <th>Puerto</th>
                        <th>Fecha de Recogida</th>
                        <th>Fecha de Entrega</th>
                        <th>Precio Total</th>
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
                            <td>${{ number_format($reservation->total_price, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.reservations.destroy', $reservation->id) }}" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Eliminar Seleccionadas</button>
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

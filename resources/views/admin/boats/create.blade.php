@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Agregar Nuevo Barco</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('boats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nombre del Barco -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Barco:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <!-- Puerto -->
                <div class="mb-3">
                    <label for="port_id" class="form-label">Puerto:</label>
                    <select id="port_id" name="port_id" class="form-select" required>
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}">{{ $port->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Capacidad -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacidad (opcional):</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" required>
                </div>

                <!-- Modificador de Precio -->
                <div class="mb-3">
                    <label for="price_modifier" class="form-label">Modificador de Precio:</label>
                    <input type="number" step="0.01" id="price_modifier" name="price_modifier" class="form-control" value="0.00" required>
                </div>

                <!-- Fotos -->
                <div class="mb-3">
                    <label for="photos" class="form-label">Fotos del Barco:</label>
                    <input type="file" id="photos" name="photos[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">Sube varias fotos del barco. Tamaño máximo: 2MB por archivo.</small>
                </div>

                <!-- Temporadas -->
                <h5 class="mt-4">Temporadas</h5>
                <div id="seasons-container" class="border p-3 rounded">
                    <div class="row g-3 mb-2 season-row">
                        <div class="col-md-3">
                            <input type="text" name="seasons[0][name]" placeholder="Nombre de la temporada" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="seasons[0][start_date]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="seasons[0][end_date]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.01" name="seasons[0][price_per_day]" placeholder="Precio por día" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-season-btn" class="btn btn-secondary mt-3">Agregar Temporada</button>

                <!-- Equipamiento -->
<h5 class="mt-4">Equipamiento</h5>
<div class="row">
    @foreach($equipments as $equipment)
        <div class="col-md-4"> <!-- Divide en columnas de 3 por fila -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="equipment-{{ $equipment->id }}" name="equipments[]" value="{{ $equipment->id }}">
                <label class="form-check-label" for="equipment-{{ $equipment->id }}">
                    {{ $equipment->name }}
                </label>
            </div>
        </div>
    @endforeach
</div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Barco</button>
                    <a href="{{ route('boats.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const seasonsContainer = document.getElementById('seasons-container');
        const addSeasonBtn = document.getElementById('add-season-btn');
        let seasonIndex = 1;

        addSeasonBtn.addEventListener('click', function () {
            const seasonRow = document.createElement('div');
            seasonRow.className = 'row g-3 mb-2 season-row';

            seasonRow.innerHTML = `
                <div class="col-md-3">
                    <input type="text" name="seasons[${seasonIndex}][name]" placeholder="Nombre de la temporada" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="seasons[${seasonIndex}][start_date]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="seasons[${seasonIndex}][end_date]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="seasons[${seasonIndex}][price_per_day]" placeholder="Precio por día" class="form-control" required>
                </div>
            `;

            seasonsContainer.appendChild(seasonRow);
            seasonIndex++;
        });
    });
</script>
@endsection

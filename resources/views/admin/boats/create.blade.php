@extends('layouts.admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Agregar Nuevo Barco</h5>
        </div>
        <div class="card-body">

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

                <!-- Descripción del Barco -->
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción del Barco:</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                </div>
           <!-- Características del Barco -->
                <div class="mb-3">
                    <label for="length" class="form-label">Eslora (m):</label>
                    <input type="number" id="length" name="length" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="beam" class="form-label">Manga (m):</label>
                    <input type="number" id="beam" name="beam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="crew" class="form-label">Tripulación:</label>
                    <input type="number" id="crew" name="crew" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="engine" class="form-label">Motor (CV):</label>
                    <input type="number" id="engine" name="engine" class="form-control" required>
                </div>

                <!-- Hora de Recogida -->
                <div class="mb-3">
                    <label for="pickup_time" class="form-label">Hora de Recogida:</label>
                    <input type="time" id="pickup_time" name="pickup_time" class="form-control" required>
                </div>

                <!-- Hora de Entrega -->
                <div class="mb-3">
                    <label for="dropoff_time" class="form-label">Hora de Entrega:</label>
                    <input type="time" id="dropoff_time" name="dropoff_time" class="form-control" required>
                </div>

                <!-- Fianza -->
                <div class="mb-3">
                    <label for="deposit" class="form-label">Fianza (€):</label>
                    <input type="number" step="0.01" id="deposit" name="deposit" class="form-control" required>
                </div>

                <h5 class="mt-4">Equipamiento Incluido</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="insurance" name="included_in_price[]" value="insurance">
                            <label class="form-check-label" for="insurance">Seguro a todo riesgo</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="drinks" name="included_in_price[]" value="drinks">
                            <label class="form-check-label" for="drinks">Bebidas</label>
                        </div>
                    </div>
                    <!-- Agrega más opciones similares aquí -->
                </div>

                <h5 class="mt-4">Equipamiento No Incluido</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="fuel" name="not_included_in_price[]" value="fuel">
                            <label class="form-check-label" for="fuel">Combustible</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="premium_drinks" name="not_included_in_price[]" value="premium_drinks">
                            <label class="form-check-label" for="premium_drinks">Bebidas premium</label>
                        </div>
                    </div>
                    <!-- Agrega más opciones similares aquí -->
                </div>


                <!-- Capacidad -->
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacidad (opcional):</label>
                    <input type="number" id="capacity" name="capacity" class="form-control">
                </div>

                <!-- Modificador de Precio -->
                <div class="mb-3">
                    <label for="price_modifier" class="form-label">Modificador de Precio:</label>
                    <input type="number" step="0.01" id="price_modifier" name="price_modifier" class="form-control" value="0.00">
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
<button type="button" id="add-season-btn" class="btn btn-secondary mt-3">Agregar Temporada</button>


<div class="check">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const seasonsContainer = document.getElementById('seasons-container');
    const addSeasonBtn = document.getElementById('add-season-btn');
    let seasonIndex = 1;

    addSeasonBtn.addEventListener('click', function () {
        console.log("Botón 'Agregar Temporada' presionado");
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

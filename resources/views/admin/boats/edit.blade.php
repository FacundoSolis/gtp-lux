@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Barco</h1>
    <form action="{{ route('boats.update', $boat->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('PUT')
        <!-- Nombre del Barco -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $boat->name) }}" required>
        </div>
            <!-- Descripción del Barco por Idiomas -->
        <!-- Descripción del Barco -->
        <div class="mb-3">
            <label for="description" class="form-label">Descripción del Barco:</label>
            <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', is_array($boat->description) ? $boat->description['es'] ?? '' : $boat->description) }}</textarea>
        </div>
        <!-- Puerto -->
        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-select" required>
                @foreach ($ports as $port)
                    <option value="{{ $port->id }}" {{ $boat->port_id == $port->id ? 'selected' : '' }}>
                        {{ $port->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Características del Barco -->
        <div class="mb-3">
            <label for="length" class="form-label">Eslora (m):</label>
            <input type="number" id="length" name="length" class="form-control" value="{{ old('length', $boat->length) }}" required>
        </div>

        <div class="mb-3">
            <label for="beam" class="form-label">Manga (m):</label>
            <input type="number" id="beam" name="beam" class="form-control" value="{{ old('beam', $boat->beam) }}" required>
        </div>

        <div class="mb-3">
            <label for="crew" class="form-label">Tripulación:</label>
            <input type="number" id="crew" name="crew" class="form-control" value="{{ old('crew', $boat->crew) }}" required>
        </div>

        <div class="mb-3">
            <label for="engine" class="form-label">Motor (CV):</label>
            <input type="number" id="engine" name="engine" class="form-control" value="{{ old('engine', $boat->engine) }}" required>
        </div>
        <!-- Hora de Recogida -->
        <div class="mb-3">
            <label for="pickup_time" class="form-label">Hora de Recogida:</label>
            <input type="time" id="pickup_time" name="pickup_time" class="form-control" value="{{ old('pickup_time', $boat->pickup_time) }}" required>
        </div>
        <!-- Hora de Entrega -->
        <div class="mb-3">
            <label for="dropoff_time" class="form-label">Hora de Entrega:</label>
            <input type="time" id="dropoff_time" name="dropoff_time" class="form-control" value="{{ old('dropoff_time', $boat->dropoff_time) }}" required>
        </div>

        <!-- Fianza -->
        <div class="mb-3">
            <label for="deposit" class="form-label">Fianza (€):</label>
            <input type="number" step="0.01" id="deposit" name="deposit" class="form-control" value="{{ old('deposit', $boat->deposit) }}" required>
        </div>
        <!-- Equipamiento Incluido -->
        <h5 class="mt-4">Equipamiento Incluido</h5>
        <div class="row">
            @foreach($equipments as $equipment)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="equipment-{{ $equipment->id }}" name="included_in_price[]" value="{{ $equipment->id }}"
                            @if(in_array($equipment->id, json_decode($boat->included_in_price) ?? [])) checked @endif>
                        <label class="form-check-label" for="equipment-{{ $equipment->id }}">
                            {{ $equipment->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Equipamiento No Incluido -->
        <h5 class="mt-4">Equipamiento No Incluido</h5>
        <div class="row">
            @foreach($equipments as $equipment)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="equipment-not-included-{{ $equipment->id }}" name="not_included_in_price[]" value="{{ $equipment->id }}"
                            @if(in_array($equipment->id, json_decode($boat->not_included_in_price) ?? [])) checked @endif>
                        <label class="form-check-label" for="equipment-not-included-{{ $equipment->id }}">
                            {{ $equipment->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Capacidad -->
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacidad (opcional):</label>
            <input type="number" id="capacity" name="capacity" class="form-control" value="{{ old('capacity', $boat->capacity) }}" required>
        </div>

        <!-- Modificador de Precio -->
        <div class="mb-3">
            <label for="price_modifier" class="form-label">Modificador de Precio:</label>
            <input type="number" step="0.01" id="price_modifier" name="price_modifier" class="form-control" value="{{ old('price_modifier', $boat->price_modifier) }}" required>
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
            @foreach ($boat->seasons as $index => $season)
                <div class="row g-3 mb-2 season-row">
                    <div class="col-md-3">
                        <input type="text" name="seasons[{{ $index }}][name]" value="{{ old('seasons.' . $index . '.name', $season->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="seasons[{{ $index }}][start_date]" value="{{ old('seasons.' . $index . '.start_date', $season->start_date) }}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="seasons[{{ $index }}][end_date]" value="{{ old('seasons.' . $index . '.end_date', $season->end_date) }}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" name="seasons[{{ $index }}][price_per_day]" value="{{ old('seasons.' . $index . '.price_per_day', $season->price_per_day) }}" class="form-control" required>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-season-btn" class="btn btn-secondary mt-3">Agregar Temporada</button>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar Barco</button>
            <a href="{{ route('boats.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const seasonsContainer = document.getElementById('seasons-container');
    const addSeasonBtn = document.getElementById('add-season-btn');
    let seasonIndex = {{ $boat->seasons->count() }}; // Inicializa con el número de temporadas existentes

    if (addSeasonBtn) {
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
    } else {
        console.error("El botón 'Agregar Temporada' no se encuentra en la página.");
    }
});

</script>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Código de País e Idioma</h1>

    <form action="{{ route('admin.codes.update', $code->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre del País -->
        <div class="mb-3">
            <label for="country_name" class="form-label">Nombre del País</label>
            <input type="text" id="country_name" name="country_name" class="form-control" value="{{ $code->country_name }}" required>
        </div>

        <!-- Código de País -->
        <div class="mb-3">
            <label for="country_code" class="form-label">Código de País</label>
            <input type="text" id="country_code" name="country_code" class="form-control" value="{{ $code->country_code }}" required>
        </div>

        <!-- Nombre del Idioma -->
        <div class="mb-3">
            <label for="language_name" class="form-label">Nombre del Idioma</label>
            <input type="text" id="language_name" name="language_name" class="form-control" value="{{ $code->language_name }}" required>
        </div>

        <!-- Código de Idioma -->
        <div class="mb-3">
            <label for="language_code" class="form-label">Código de Idioma</label>
            <input type="text" id="language_code" name="language_code" class="form-control" value="{{ $code->language_code }}" required>
        </div>

        <!-- Bandera -->
        <div class="mb-3">
            <label for="flag" class="form-label">Código de la Bandera</label>
            <select id="flag" name="flag" class="form-select" required>
                @foreach (config('languages') as $key => $lang)
                    <option value="{{ $key }}" {{ $key == $code->flag ? 'selected' : '' }}>
                        {{ $lang['name'] }}
                    </option>
                @endforeach
            </select>
            <!-- Vista previa de la bandera -->
            <div class="mt-2">
                <img id="flag-preview" src="{{ asset('path_to_flags/' . $code->flag . '.png') }}" 
                     alt="Vista previa de la bandera" 
                     style="width: 24px; height: auto;">
            </div>
        </div>

        <!-- Botón de Actualizar -->
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flagSelect = document.getElementById('flag');
        const flagPreview = document.getElementById('flag-preview');

        // Cambiar la vista previa de la bandera al cambiar la selección
        flagSelect.addEventListener('change', function () {
            flagPreview.src = `/path_to_flags/${flagSelect.value}.png`;
        });
    });
</script>
@endsection

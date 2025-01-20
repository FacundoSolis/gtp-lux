@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Agregar Nueva Traducción</h1>

    <!-- Mostrar mensaje de éxito -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Botón para volver al listado -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('admin.translations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <!-- Formulario -->
    <form action="{{ route('admin.translations.store') }}" method="POST">
        @csrf
        <!-- Campo Key -->
        <div class="form-group">
            <label for="key_name">Key</label>
            <input type="text" name="key_name" id="key_name" class="form-control" value="{{ old('key_name') }}" required>
            <small id="keyNameMessage" class="form-text text-danger" style="display: none;"></small>
            @error('key_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Checkbox ¿Multilanguage? -->
        <div class="form-group">
            <label for="is_multilanguage">¿Multilanguage?</label>
            <input type="checkbox" name="is_multilanguage" id="is_multilanguage" value="1" checked>
        </div>

        <!-- Campo Default Value -->
        <div class="form-group">
            <label for="default_value">Default Value</label>
            <input type="text" name="default_value" id="default_value" class="form-control" value="{{ old('default_value') }}" required>
            <small id="defaultValueMessage" class="form-text text-danger" style="display: none;"></small>
            @error('default_value')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Idiomas -->
        <div id="languages-container">
            <h5>Traducciones por Idioma</h5>
            @foreach (config('languages') as $code => $language)
            <div class="form-group">
                <label for="language_{{ $code }}">
                    <img src="{{ asset('path_to_flags/' . $code . '.png') }}" 
                         alt="Bandera de {{ $language['name'] }}" 
                         title="{{ $language['name'] }}" 
                         style="width: 20px; height: 15px; margin-right: 5px;">
                    {{ $language['name'] }}
                </label>
                <input type="text" name="languages[{{ $code }}]" id="language_{{ $code }}" class="form-control" value="{{ old('languages.' . $code) }}">
            </div>
            @endforeach
        </div>

        <!-- Botón para enviar -->
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    // Validar en tiempo real el campo Key
    document.getElementById('key_name').addEventListener('input', function () {
        validateField(this.value.trim(), 'key_name', 'keyNameMessage');
    });

    // Validar en tiempo real el campo Default Value
    document.getElementById('default_value').addEventListener('input', function () {
        validateField(this.value.trim(), 'default_value', 'defaultValueMessage');
    });

    // Función para validar un campo
    function validateField(value, fieldName, messageElementId) {
        const messageElement = document.getElementById(messageElementId);
        const url = "{{ route('admin.translations.checkKey') }}";

        // Si el campo está vacío, limpiar el mensaje
        if (!value) {
            messageElement.style.display = 'none';
            messageElement.textContent = '';
            return;
        }

        // Hacer la solicitud AJAX
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ key_name: value })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                // Mostrar mensaje de error si el valor ya existe
                messageElement.style.display = 'block';
                messageElement.textContent = `El valor ingresado ya existe en el sistema. Por favor, elige otro.`;
            } else {
                // Ocultar el mensaje si el valor está disponible
                messageElement.style.display = 'none';
                messageElement.textContent = '';
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Asegurarse de que los idiomas estén visibles si el checkbox está activado
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('languages-container').style.display = document.getElementById('is_multilanguage').checked ? 'block' : 'none';
    });

    // Mostrar u ocultar los idiomas según el checkbox
    document.getElementById('is_multilanguage').addEventListener('change', function () {
        document.getElementById('languages-container').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection

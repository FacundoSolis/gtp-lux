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

    <!-- Botón para agregar un nuevo idioma -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('admin.translations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <form action="{{ route('admin.translations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="key_name">Key</label>
            <input type="text" name="key_name" id="key_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_multilanguage">¿Multilanguage?</label>
            <input type="checkbox" name="is_multilanguage" id="is_multilanguage" value="1">
        </div>
        <div class="form-group">
            <label for="default_value">Default Value</label>
            <input type="text" name="default_value" id="default_value" class="form-control" required>
        </div>
        <div id="languages-container" style="display: none;">
            <h5>Traducciones por Idioma</h5>
            @foreach (config('languages') as $code => $language)
            <div class="form-group">
                <label for="language_{{ $code }}">
                    <span class="flag">{{ $language['flag'] }}</span> {{ $language['name'] }}
                </label>
                <input type="text" name="languages[{{ $code }}]" id="language_{{ $code }}" class="form-control" placeholder="Traducción en {{ $language['name'] }}">
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    document.getElementById('is_multilanguage').addEventListener('change', function() {
        document.getElementById('languages-container').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection

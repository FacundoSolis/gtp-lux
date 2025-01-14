@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Traducción</h1>
    <form action="{{ route('admin.translations.update', $translation->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="key_name">Key</label>
            <input type="text" name="key_name" id="key_name" class="form-control" value="{{ $translation->key_name }}" required>
        </div>
        <div class="form-group">
            <label for="default_value">Default Value</label>
            <input type="text" name="default_value" id="default_value" class="form-control" 
                   value="{{ $translation->default_value ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="is_multilanguage">¿Multilanguage?</label>
            <input type="checkbox" name="is_multilanguage" id="is_multilanguage" value="1" 
                   {{ $translation->is_multilanguage ? 'checked' : '' }}>
        </div>
        <div id="languages-container" style="{{ $translation->is_multilanguage ? 'block' : 'none' }}">
            @foreach (config('languages') as $code => $language)
            <div class="form-group">
                <label for="language_{{ $code }}">
                    <span class="flag">{{ $language['flag'] }}</span> {{ $language['name'] }}
                </label>
                <input type="text" name="languages[{{ $code }}]" id="language_{{ $code }}" class="form-control"
                       value="{{ $translation->languages->firstWhere('language_code', $code)?->value ?? '' }}">
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>

<script>
    document.getElementById('is_multilanguage').addEventListener('change', function() {
        document.getElementById('languages-container').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection

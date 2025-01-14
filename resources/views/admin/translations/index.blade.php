@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestión de Traducciones</h1>

    <!-- Mostrar mensaje de éxito -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Botón para añadir una nueva traducción -->
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('admin.translations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Añadir Nueva Traducción
        </a>
        <a href="{{ route('admin.translations.export') }}" class="btn btn-success">
            <i class="fas fa-file-export"></i> Exportar Traducciones
        </a>
        <form id="search-form" action="{{ route('admin.translations.index') }}" method="GET" class="d-flex">
            <input id="search-input" type="text" name="search" class="form-control me-2" placeholder="Buscar por clave o valor..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">
                <i class="fas fa-search"></i> Buscar
            </button>
        </form>
        <button id="delete-selected" class="btn btn-danger" onclick="deleteSelected()" disabled>
            <i class="fas fa-trash"></i> Eliminar Seleccionadas
        </button>
    </div>

    <!-- Tabla de Traducciones -->
    <form id="bulk-delete-form" action="{{ route('admin.translations.bulkDelete') }}" method="POST">
        @csrf
        @method('DELETE')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>No</th>
                    <th>Key</th>
                    <th>Props (Multilang)</th>
                    <th>Default Value</th>
                    <th>Banderas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($translations as $index => $translation)
                <tr>
                    <td>
                        <input type="checkbox" name="ids[]" value="{{ $translation->id }}" class="select-checkbox">
                    </td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $translation->key_name }}</td>
                    <td>{{ $translation->is_multilanguage ? 'Yes' : 'No' }}</td>
                    <td>{{ $translation->default_value }}</td>
                    <td>
                        @foreach (config('languages') as $code => $language)
                            @php
                                $hasTranslation = $translation->languages->firstWhere('language_code', $code);
                            @endphp
                            <span title="{{ $language['name'] }}" style="opacity: {{ $hasTranslation ? 1 : 0.3 }};">
                                {{ $language['flag'] }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Botones de Acciones -->
                        <a href="{{ route('admin.translations.edit', $translation->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.translations.destroy', $translation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar traducción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.select-checkbox');
    const deleteButton = document.getElementById('delete-selected');
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');

    searchInput.addEventListener('input', function () {
        if (this.value.trim() === '') {
            searchForm.submit();
        }
    });

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        toggleDeleteButton();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', toggleDeleteButton));

    function toggleDeleteButton() {
        const selected = Array.from(checkboxes).some(cb => cb.checked);
        deleteButton.disabled = !selected;
    }

    function deleteSelected() {
        if (confirm('¿Eliminar traducciones seleccionadas?')) {
            document.getElementById('bulk-delete-form').submit();
        }
    }
</script>
@endsection

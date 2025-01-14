@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestión de Códigos de Países e Idiomas</h1>

    <a href="{{ route('admin.codes.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Añadir Nuevo
    </a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>País</th>
            <th>Código de País</th>
            <th>Idioma</th>
            <th>Código de Idioma</th>
            <th>Bandera</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($codes as $code)
        @php
            // Cargar la configuración de idiomas
            $languages = config('languages');
            $flag = $languages[$code->language_code]['flag'] ?? 'default_flag';
        @endphp
        <tr>
            <td>{{ $code->country_name }}</td>
            <td>{{ $code->country_code }}</td>
            <td>{{ $code->language_name }}</td>
            <td>{{ $code->language_code }}</td>
            <td>
                <img src="{{ asset('path_to_flags/' . strtolower($code->language_code) . '.png') }}" 
                     alt="{{ $code->language_name }}" 
                     title="{{ $languages[$code->language_code]['name'] ?? 'Idioma' }}" 
                     style="width: 24px; height: auto;">
            </td>
            <td>
                <a href="{{ route('admin.codes.edit', $code->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('admin.codes.destroy', $code->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este código?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
</table>

</div>
@endsection

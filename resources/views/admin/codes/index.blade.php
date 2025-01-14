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
                <th>Language</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($codes as $code)
            <tr>
                <td>{{ $code->country_name }}</td>
                <td>{{ $code->country_code }}</td>
                <td>{{ $code->language_name }}</td>
                <td>{{ $code->language_code }}</td>
                <td>{{ $code->flag }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

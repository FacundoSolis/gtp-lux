@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestión de Secciones</h1>
    <a href="{{ route('admin.sections.create') }}" class="btn btn-success mb-3">Añadir Nueva Sección</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Meta Título</th>
                <th>Meta Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sections as $section)
                <tr>
                    <td>{{ $section->id }}</td>
                    <td>{{ $section->section_name }}</td>
                    <td>{{ $section->meta_title }}</td>
                    <td>{{ $section->meta_description }}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        
                        <!-- Condicional para el botón Deploy -->
                        @if (!$section->is_deployed)
                            <form action="{{ route('admin.sections.deploy', $section->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-success btn-sm">Deploy</button>
                            </form>
                        @else
                            <span class="badge bg-success">Publicado</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay secciones disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

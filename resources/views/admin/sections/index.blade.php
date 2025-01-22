@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestión de Secciones</h1>
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
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->meta_title }}</td>
                    <td>{{ $section->meta_description }}</td>
                    <td>
                        <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('admin.sections.deploy', $section->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Deploy</button>
                        </form>
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

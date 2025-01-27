@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Sección: {{ $section->section_name }}</h1>

    <form action="{{ route('admin.sections.update', $section) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Título</label>
            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ $section->meta_title }}">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Descripción</label>
            <textarea id="meta_description" name="meta_description" class="form-control">{{ $section->meta_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <textarea id="meta_keywords" name="meta_keywords" class="form-control">{{ $section->meta_keywords }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea id="content" name="content" class="form-control" rows="10">{{ $section->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection

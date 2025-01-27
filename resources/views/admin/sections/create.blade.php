@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Nueva Sección</h1>

    <form action="{{ route('admin.sections.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="section_name" class="form-label">Nombre de la Sección</label>
            <input type="text" id="section_name" name="section_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="template_name" class="form-label">Nombre de la Plantilla</label>
            <input type="text" id="template_name" name="template_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Título</label>
            <input type="text" id="meta_title" name="meta_title" class="form-control">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Descripción</label>
            <textarea id="meta_description" name="meta_description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <textarea id="meta_keywords" name="meta_keywords" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea id="content" name="content" class="form-control" rows="10"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
